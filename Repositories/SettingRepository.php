<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Repositories;

use Gdevilbat\SpardaCMS\Modules\Core\Repositories;
use Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting as Setting_m;

/**
 * Class EloquentCoreRepository
 *
 * @package Gdevilbat\SpardaCMS\Modules\Core\Repositories\Eloquent
 */
class SettingRepository extends AbstractRepository
{
	public function __construct()
    {
        $this->model = new Setting_m;
    }

    public static function getThemeCms()
    {
        return Setting_m::where('name', 'theme_cms')->first();
    }

    public static function getThemePublic()
    {
        return Setting_m::where('name', 'theme_public')->first();
    }
}
