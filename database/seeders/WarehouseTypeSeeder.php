<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\WarehouseType;
use Carbon\Carbon;

class WarehouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        WarehouseType::truncate();
        $records = [
            [
                'id'         => 1,
                'code'       => '100',
                'name'       => 'Marfuri',
                'type'       => 'Cantitativ valorica',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        WarehouseType::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
