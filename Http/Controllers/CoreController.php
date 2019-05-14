<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Gdevilbat\SpardaCMS\Modules\Core\Repositories\SettingRepository;
use Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting as Setting_m;

class CoreController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;

    public function __construct()
    {
        $settings = Setting_m::all();
        $settings_cms = $settings->where('name', 'theme_cms');
        $theme_cms = null;
        foreach ($settings_cms as $key => $value) 
        {
            $theme_cms = $value;
        }
        if(empty($theme_cms))
            throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler("Theme CMS Setting Not Available");

        $settings_public =  $settings->where('name', 'theme_public');
        $theme_public = null;
        foreach ($settings_public as $key => $value) 
        {
            $theme_public = $value;
        }
        if(empty($theme_public))
            throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler("Theme Public Setting Not Available");

        $this->data['theme_cms'] = $theme_cms;
        $this->data['theme_public'] = $theme_public;
        $this->data['settings'] = $settings;
    }

    protected function print_r($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
}
