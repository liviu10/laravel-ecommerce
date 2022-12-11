<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserRoleType;
use Carbon\Carbon;

class UserRoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        UserRoleType::truncate();
        $records = [
            [
                'id'                    => '1',
                'user_role_name'        => 'Webmaster',
                'user_role_description' => 'A user with access to the website network administration features and all other features that are included for the rest of the user role types (administrator, author, editor, contributor and subscriber).',
                'user_role_slug'        => 'webmaster',
                'user_role_is_active'   => '1',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => '2',
                'user_role_name'        => 'Administrator',
                'user_role_description' => 'A user with access to all the administration features withing a single website and all other features that are included for the rest of the user role types (author, editor, contributor and subscriber).',
                'user_role_slug'        => 'administrator',
                'user_role_is_active'   => '1',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => '3',
                'user_role_name'        => 'Client',
                'user_role_description' => 'A user who can publish and manage their own posts and content.',
                'user_role_slug'        => 'client',
                'user_role_is_active'   => '1',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
        ];
        UserRoleType::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
