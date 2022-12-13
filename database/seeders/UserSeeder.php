<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Settings\User;
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
                'email'             => 'webmaster' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '1',
                'password'          => bcrypt('123@UserWebmaster'),
            ],
            [
                'id'                => '2',
                'name'              => 'Administrator',
                'nickname'          => 'administrator',
                'email'             => 'administrator' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '2',
                'password'          => bcrypt('123@UserAdministrator'),
            ],
            [
                'id'                => '3',
                'name'              => 'Accountant',
                'nickname'          => 'accountant',
                'email'             => 'accountant' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '3',
                'password'          => bcrypt('123@UserAccountant'),
            ],
            [
                'id'                => '4',
                'name'              => 'Sales',
                'nickname'          => 'sales',
                'email'             => 'sales' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '4',
                'password'          => bcrypt('123@UserSales'),
            ],
            [
                'id'                => '5',
                'name'              => 'Client',
                'nickname'          => 'client',
                'email'             => 'client' . config('app.domain_name'),
                'email_verified_at' => Carbon::now(),
                'user_role_type_id' => '5',
                'password'          => bcrypt('123@UserClient'),
            ]
        ];
        User::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
