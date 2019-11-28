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

        if(file_exists(base_path('resources/views/modules/SpardaCMS/'.$tmp[0].'/'.$asset)))
        {
            return base_path('resources/views/modules/SpardaCMS/'.$tmp[0].'/'.$asset);
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
        if(config('filesystems.disks.'.config('filesystems.default').'.driver') == 's3')
            return Storage::temporaryUrl($path, now()->addMinutes(5));

        return Storage::url($path);
    }
}