<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CityRepository;
use App\Http\Repositories\RegionRepository;
use App\Http\Requests\RegionRequest;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public $region;
    public $city;

    public function __construct(RegionRepository $region,
                                CityRepository $city)
    {
        $this->region=$region;
        $this->city=$city;

    }

    public function index()
    {
        return view('Dashboard.Region.index',[
            'regions' => $this->region->all()
        ]);
    }
    public function create()
    {
        return view('Dashboard.Region.create',[
            'cities' => $this->city->all()
        ]);
    }

    public function store(RegionRequest $request)
    {
        $validate = $request->validated();
        $this->region->store($validate);
        session()->flash('success',__('main.added_success'));
        return redirect()->route('region.index');
    }

    public function edit($id)
    {
        return view('Dashboard.Region.edit',[
            'region' => $this->region->show($id),
            'cities' => $this->city->all()
        ]);
    }

    public function update(RegionRequest $request ,$id)
    {
        $validate = $request->validated();
        $this->region->update($validate,$id);
        session()->flash('success',__('main.edited_success'));
        return redirect()->route('region.index');
    }

    public function delete($id)
    {
        $this->region->delete($id);
        session()->flash('success',__('main.deleted_success'));
        return redirect()->route('region.index');

    }
}
