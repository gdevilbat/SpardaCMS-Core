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

        if(file_exists(base_path('resources/views/modules/SpardaCMS/'.$tmp[0].'/'.$asset)))
        {
            return asset('resources/views/modules/SpardaCMS/'.$tmp[0].'/'.$asset);
        }elseif(file_exists(base_path('vendor/gdevilbat/SpardaCMS'.$tmp[0].'/'.$tmp[1])))
        {
            return asset('vendor/gdevilbat/SpardaCMS'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }elseif(file_exists(base_path('Modules/SpardaCMS'.$tmp[0].'/'.$tmp[1]))) 
        {
            return asset('Modules/SpardaCMS'.$tmp[0].'/'.$tmp[1]);
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

        if(file_exists(base_path('resources/views/modules/SpardaCMS/'.$tmp[0].'/'.$asset)))
        {
            return base_path('resources/views/modules/SpardaCMS/'.$tmp[0].'/'.$asset);
        }elseif(file_exists(base_path('vendor/gdevilbat/SpardaCMS'.$tmp[0].'/'.$tmp[1])))
        {
            return base_path('vendor/gdevilbat/SpardaCMS'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }elseif(file_exists(base_path('Modules/SpardaCMS'.$tmp[0].'/'.$tmp[1]))) 
        {
            return base_path('Modules/SpardaCMS'.$tmp[0].'/'.$tmp[1]);
        }

        return Module::getModulePath($tmp[0]).$tmp[1];
    }
}