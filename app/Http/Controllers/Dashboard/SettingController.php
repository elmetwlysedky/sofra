<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SettingRepository;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected SettingRepository $setting;
    public function __construct(SettingRepository $param)
    {
        $this->setting=$param;
    }

    public function about()
    {

        return view('Dashboard.Setting.about',[
            'data' => $this->setting->about()
        ]);
    }

    public function update_about(Request $request)
    {
        $validate = $request->validate([
            'commission' =>'required|string|max:255'
        ]);
        $this->setting->update_about($validate);
        session()->flash('success',__('main.edited_success'));
        return redirect()->back();
    }

    public function commission()
    {
        return view('Dashboard.Setting.commission',[
            'data'=>$this->setting->commission()
        ]);
    }

    public function update_commission(Request $request)
    {
        $validate = $request->validate([
            'commission' =>'required|string|max:255'
        ]);
        $this->setting->update_commission($validate);
        session()->flash('success',__('main.edited_success'));
        return redirect()->back();
    }

    public function general()
    {

        return view('Dashboard.Setting.general',[
            'data'=>$this->setting->general()
        ]);
    }

    public function update_general(SettingRequest $request)
    {
        $validate = $request->validated();
        $this->setting->update_general($validate);
        session()->flash('success',__('main.edited_success'));
        return redirect()->back();
    }
}
