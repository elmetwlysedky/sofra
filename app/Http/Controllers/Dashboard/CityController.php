<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CityRepository;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public $city;

    public function __construct(CityRepository $city)
    {
        $this->city=$city;
    }

    public function index()
    {
        return view('Dashboard.City.index',[
           'cities' => $this->city->all()
        ]);
    }
    public function create()
    {
        return view('Dashboard.City.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' =>'required|string|max:255'
        ]);
        $this->city->store($validate);
        session()->flash('success',__('main.added_success'));
        return redirect()->route('city.index');
    }

    public function edit($id)
    {
        return view('Dashboard.City.edit',[
            'city' => $this->city->show($id)
        ]);
    }

    public function update(Request $request ,$id)
    {
        $validate = $request->validate([
            'name' =>'required|string|max:255'
        ]);
        $this->city->update($validate,$id);
        session()->flash('success',__('main.edited_success'));
        return redirect()->route('city.index');
    }

    public function delete($id)
    {
        $this->city->delete($id);
        session()->flash('success',__('main.deleted_success'));
        return redirect()->route('city.index');

    }
}
