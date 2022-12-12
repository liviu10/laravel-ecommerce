<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\CompanyDetails;
use Carbon\Carbon;

class CompanyDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        CompanyDetails::truncate();
        $records = [
            [
                'id'                 => 1,
                'company_id'         => 1,
                'country_id'         => 141,
                'county_id'          => 42,
                'city_id'            => 3181,
                'address'            => 'Strada Testului, nr. 12, sc. 2, et. 2, ap. 2, Sector 1',
                'bank_name'          => 'ING Bank',
                'bank_account'       => 'RO66BACX0000001234567890',
                'phone'              => '0760000000',
                'email_address'      => 'admin@localhost.com',
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ],
        ];
        CompanyDetails::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
