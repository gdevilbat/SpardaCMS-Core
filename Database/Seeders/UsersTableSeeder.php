<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

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

        DB::table('users')->insert([
            [
                'email' => 'admin@default.app',
                'password' => bcrypt('smartnaco'),
                'name' => 'Super Admin',
            ],
        ]);
    }
}
