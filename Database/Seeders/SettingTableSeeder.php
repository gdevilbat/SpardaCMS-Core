<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

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

        DB::table('setting')->insert([
            [
                'name' => 'theme_public',
                'value' => json_encode('classic'),
            ],
            [
                'name' => 'theme_cms',
                'value' => json_encode('v_1'),
            ],
        ]);
    }
}
