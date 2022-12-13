<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\AccountType;
use Carbon\Carbon;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        AccountType::truncate();
        $records = [
            [
                'id'         => 1,
                'code'       => 'A',
                'name'       => 'Activ',
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 2,
                'code'       => 'P',
                'name'       => 'Pasiv',
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 3,
                'code'       => 'Bi',
                'name'       => 'Bifunctional',
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        AccountType::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
