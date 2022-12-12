<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\Country;
use Carbon\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Country::truncate();
        $csvFile = fopen(base_path('database/csv/countries.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                Country::create([
                    'id'   => $data['0'],
                    'name' => $data['1'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
