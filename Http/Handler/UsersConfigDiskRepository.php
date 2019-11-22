<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Handler;

use Alexusmai\LaravelFileManager\Services\ConfigService\ConfigRepository;
use Alexusmai\LaravelFileManager\Services\ConfigService\DefaultConfigRepository;

class UsersConfigDiskRepository extends DefaultConfigRepository  implements ConfigRepository
{
    public function getDiskList(): array
    {
        if (\Auth::id() === 1) {
            return array_keys(config('filesystems.disks'));
        }
        
        return [config('filesystems.default')];
    }
}