<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        $records = [
            [
                'id'                => '1',
                'name'              => 'Webmaster',
                'nickname'          => 'webmaster',
                'email'             => 'webmaster@localhost.com',
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '1',
                'password'          => bcrypt('123@UserWebmaster'),
            ],
            [
                'id'                => '2',
                'name'              => 'Administrator',
                'nickname'          => 'administrator',
                'email'             => 'administrator@localhost.com',
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '2',
                'password'          => bcrypt('123@UserAdministrator'),
            ],
            [
                'id'                => '3',
                'name'              => 'Client',
                'nickname'          => 'client',
                'email'             => 'client@localhost.com',
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '3',
                'password'          => bcrypt('123@UserClient'),
            ]
        ];
        User::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
