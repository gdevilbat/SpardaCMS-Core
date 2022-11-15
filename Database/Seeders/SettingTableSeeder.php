<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

use Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Setting::firstOrCreate(
            [ 'name' => 'theme_public'],
            [
                'name' => 'theme_public',
                'value' => 'classic',
            ],
        );

        Setting::firstOrCreate(
            [ 'name' => 'theme_cms'],
            [
                'name' => 'theme_cms',
                'value' => 'v_1',
            ],
        );
    }
}
