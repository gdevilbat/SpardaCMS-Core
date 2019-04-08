<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;
use Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting;

use Carbon\Carbon;
use Schema;
use Config;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if(Schema::hasTable('setting'))
        {
            $setting_m = new Repository(new Setting);
            $settings = $setting_m->all();
            $settings_cms = $settings->where('name', 'theme_cms');
            $setting_cms = null;
            foreach ($settings_cms as $key => $value) 
            {
                $setting_cms = $value;
            }

            $settings_public =  $settings->where('name', 'theme_public');
            $setting_public = null;
            foreach ($settings_public as $key => $value) 
            {
                $setting_public = $value;
            }

            \View::share(
                    [
                    'theme_cms' => $setting_cms,
                    'theme_public' => $setting_public,
                    'settings' => $settings,
                ]
            );
            
            Config::set(['settings' => $settings]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
