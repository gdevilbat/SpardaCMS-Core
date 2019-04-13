<?php

if (! function_exists('module_asset')) {
    function module_asset($path)
    {
        $tmp = explode(':', $path);

        if(count($tmp) != 2)
            throw new Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler("Wrong Format Path");

        if(file_exists(base_path('resources/modules/SpardaCMS/'.$tmp[0].'/'.$tmp[1])))
        {
            return asset('resources/modules/SpardaCMS/'.$tmp[0].'/'.$tmp[1]);
        }elseif(file_exists(base_path('vendor/gdevilbat/SpardaCMS'.$tmp[0].'/'.$tmp[1])))
        {
            return asset('vendor/gdevilbat/SpardaCMS'.ucfirst($tmp[0]).'/'.$tmp[1]);
        }

        return Module::asset($path);
    }
}