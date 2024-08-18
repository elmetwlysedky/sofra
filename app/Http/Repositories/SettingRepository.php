<?php

namespace App\Http\Repositories;

use App\Settings\AccountSetting;
use App\Settings\GeneralSettings;
use App\Settings\InformationSetting;

class SettingRepository
{
    protected $general;
    protected $commission;
    protected $about;


    public function __construct(GeneralSettings $general,
                                AccountSetting $commission,
                                InformationSetting $about)
    {
        $this->general = $general;
        $this->commission = $commission;
        $this->about = $about;

    }
    public function commission()
    {
        return  $this->commission->toArray();
    }

    public function update_commission($request)
    {
        $this->commission->commission = $request['commission'];
        $this->commission->save();
    }

    public function about()
    {
        return  $this->about->toArray();

    }

    public function update_about($request)
    {
        $this->about->about = $request['about'];
        $this->about->save();
    }

    public function general()
    {
        return  $this->general->toArray();

    }

    public function update_general($request)
    {
        $this->general->site_name = $request['site_name'];
        $this->general->facebook = $request['facebook'];
        $this->general->whats_app = $request['whats_app'];
        $this->general->instagram = $request['instagram'];
        $this->general->twitter = $request['twitter'];
        $this->general->link_app_store = $request['link_app_store'];
        $this->general->link_google_play = $request['link_google_play'];
        $this->general->save();
    }

}
