<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Services\Support;

use Illuminate\Support\Facades\Facade;

class StorageService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Gdevilbat\SpardaCMS\Modules\Core\Services\Contract\BaseStorageService::class;
    }
}
