<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AccountSetting extends Settings
{

    public int $commission;

    public static function group(): string
    {
        return 'accounts';
    }
}
