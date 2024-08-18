<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SettingRepository;
use App\Traits\JsonResponseTrait;


class SettingController extends Controller
{
    use JsonResponseTrait;

    protected SettingRepository $setting;
    public function __construct(SettingRepository $param)
    {
        $this->setting=$param;
    }

    public function about()
    {
        $data = $this->setting->about();
        return $this->jsonSuccess($data);
    }

    public function commission()
    {
        $data = $this->setting->commission();
        return $this->jsonSuccess($data);
    }
    public function social()
    {
        $data = $this->setting->general();
        return $this->jsonSuccess($data);
    }
}
