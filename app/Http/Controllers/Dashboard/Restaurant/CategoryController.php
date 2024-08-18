<?php

namespace App\Http\Controllers\Dashboard\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\CategoryRepository;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $param)
    {
        $this->category=$param;
    }

    public function index()
    {
        return view('Dashboard.Category.index',[
            'categories' => $this->category->all()
        ]);
    }

    public function create()
    {
        return view('Dashboard.Category.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $this->category->store($validate);
        session()->flash('success',__('main.added_success'));
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        return view('Dashboard.Category.edit',[
            'category' => $this->category->show($id)
        ]);
    }

    public function update(Request $request , $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $this->category->update($validate,$id);
        session()->flash('success',__('main.edited_success'));
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        Restaurant::where('category_id', $id)->delete();
        $this->category->delete($id);
        session()->flash('success',__('main.deleted_success'));
        return redirect()->route('category.index');

    }
}
