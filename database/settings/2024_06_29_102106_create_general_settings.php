<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Sofra');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.whats_app', '');
        $this->migrator->add('general.link_app_store', '');
        $this->migrator->add('general.link_google_play', '');
        $this->migrator->add('general.facebook', '');
        $this->migrator->add('general.twitter', '');
        $this->migrator->add('general.instagram', '');

    }
};
