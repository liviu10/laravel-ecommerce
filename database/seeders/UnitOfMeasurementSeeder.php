<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\UnitOfMeasurement;
use Carbon\Carbon;

class UnitOfMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        UnitOfMeasurement::truncate();
        $csvFile = fopen(base_path('database/csv/unit_of_measurements.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                UnitOfMeasurement::create([
                    'id'   => $data['0'],
                    'code' => $data['1'],
                    'name' => $data['2'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
