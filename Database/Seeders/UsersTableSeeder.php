<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

use  Gdevilbat\SpardaCMS\Modules\Core\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::firstOrCreate(
            ['email' => 'admin@default.app'],
            [
                
                'password' => 'smartnaco',
                'name' => 'Super Admin',
            ],
        );
    }
}
