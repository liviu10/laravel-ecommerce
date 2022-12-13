<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\Company;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Company::truncate();
        $records = [
            [
                'id'                             => 1,
                'list_of_economic_activities_id' => 413,
                'name'                           => 'S.C. COMPANIE DE TEST S.R.L.',
                'fiscal_code'                    => 'RO123456',
                'registration_number'            => 'J40/12/2022',
                'social_capital'                 => 200.00,
                'user_id'                        => 1,
                'created_at'                     => Carbon::now(),
                'updated_at'                     => Carbon::now(),
            ],
        ];
        Company::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
