<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('information.about', '');
        $this->migrator->add('information.who_we_are', '');

    }
};
