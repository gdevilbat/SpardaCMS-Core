<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

use Gdevilbat\SpardaCMS\Modules\Core\Entities\Module;

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

        Module::firstOrCreate(
            ['slug' => 'test'],
            [
                'name' => 'test',
                'created_at' => \Carbon\Carbon::now()
            ],
        );

        Module::firstOrCreate(
            ['slug' => 'core'],
            [
                'name' => 'Core',
                'is_scanable' => '1',
                'scope' => array('menu','menu-filemanager', 'full-control-filemanager', 'delete-filemanager', 'permission'),
                'order' => 999999,
                'created_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
