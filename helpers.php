<?php

if (! function_exists('module_asset_url')) {
    function module_asset_url($path)
    {
        $tmp = explode(':', $path);

        if(count($tmp) != 2)
            throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler("Wrong Format Path");

        if(strpos($path, 'resources/views') !== false)
        {
            $asset = str_replace('resources/views/', '', $tmp['1']);
        }
        else
        {
            $asset = $tmp[1];
        }

        if(file_exists(base_path('resources/views/Modules/SpardaCMS/'.$tmp[0].'/'.$asset)))
        {
            return asset('resources/views/Modules/SpardaCMS/'.$tmp[0].'/'.$asset);
        }elseif(file_exists(base_path('vendor/gdevilbat/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1])))
        {
            return asset('vendor/gdevilbat/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }elseif(file_exists(base_path('Modules/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1]))) 
        {
            return asset('Modules/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }

        return Module::asset($path);
    }
}

if (! function_exists('module_asset_path')) {
    function module_asset_path($path)
    {
        $tmp = explode(':', $path);

        if(count($tmp) != 2)
            throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler("Wrong Format Path");

        if(strpos($path, 'resources/views') !== false)
        {
            $asset = str_replace('resources/views/', '', $tmp['1']);
        }
        else
        {
            $asset = $tmp[1];
        }

        if(file_exists(base_path('resources/views/Modules/SpardaCMS/'.$tmp[0].'/'.$asset)))
        {
            return base_path('resources/views/Modules/SpardaCMS/'.$tmp[0].'/'.$asset);
        }elseif(file_exists(base_path('vendor/gdevilbat/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1])))
        {
            return base_path('vendor/gdevilbat/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }elseif(file_exists(base_path('Modules/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1]))) 
        {
            return base_path('Modules/SpardaCms'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }

        return Module::getModulePath($tmp[0]).$tmp[1];
    }
}

if (! function_exists('generate_storage_url')) {
    function generate_storage_url($path, $time = 5)
    {
        if(is_url($path))
        {
            return url($path);
        }
        else
        {
            try {
                return Storage::temporaryUrl($path, now()->addMinutes(5));
            } catch (\Exception $e) {
                if($e->getMessage() == 'This driver does not support creating temporary URLs.')
                    return Storage::url($path);
            }
        }

    }
}

if (! function_exists('is_url')) {
    function is_url($uri){
        if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$uri)){
          return true;
        }
        else{
            return false;
        }
    }
}

if (! function_exists('getSettingConfig')) {
    function getSettingConfig($column, $index = null){
        if(empty(Config::get('settings')))
        {
            $settings = \Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting::where('name', $column)->get();
        }
        else
        {
            $settings = Config::get('settings')->where('name', $column);
        }

        if($settings->count() <= 0)
            return null;

        $setting = $settings->first()->value;

        if(is_array($setting) && isset($index))
        {
            $array_dot = \Illuminate\Support\Arr::dot($setting);
            if(isset($setting[$index]))
                return $setting[$index];

            return null;
        }

        return $setting;
    }
}