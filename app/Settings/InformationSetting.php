<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class InformationSetting extends Settings
{
    public string $about;

    public static function group(): string
    {
        return 'information';
    }
}
