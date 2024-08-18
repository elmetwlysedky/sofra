<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public string $facebook;
    public string $instagram;
    public string $twitter;
    public string $whats_app;
    public string $link_app_store;
    public string $link_google_play;

    public static function group(): string
    {
        return 'general';
    }
}
