<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('module')->insert([
            [
                'name' => 'test',
                'slug' => 'test',
                'created_at' => \Carbon\Carbon::now()
            ],
        ]);

        DB::table('module')->insert([
            [
                'name' => 'Core',
                'slug' => 'core',
                'is_scanable' => '1',
                'scope' => json_encode(array('menu-filemanager', 'full-control-filemanager', 'delete-filemanager', 'permission')),
                'order' => 999999,
                'created_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
