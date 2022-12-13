<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\VatType;
use Carbon\Carbon;

class VatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        VatType::truncate();
        $records = [
            [
                'id'         => 1,
                'code'       => 'TVA_5',
                'name'       => 'TVA 5%',
                'value'      => 5,
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 2,
                'code'       => 'TVA_9',
                'name'       => 'TVA 9%',
                'value'      => 9,
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 3,
                'code'       => 'TVA_19',
                'name'       => 'TVA 19%',
                'value'      => 19,
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        VatType::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
