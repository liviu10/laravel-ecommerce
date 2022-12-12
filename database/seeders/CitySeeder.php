<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        City::truncate();
        $csvFile = fopen(base_path('database/csv/cities.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                City::create([
                    'id'              => $data['0'],
                    'county_id'       => $data['1'],
                    'siruta_code'     => $data['2'],
                    'name'            => $data['3'],
                    'longitude'       => $data['4'],
                    'latitude'        => $data['5'],
                    'google_maps_url' => $data['6'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
