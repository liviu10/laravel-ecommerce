<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\CurrencyCode;
use Carbon\Carbon;

class CurrencyCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        CurrencyCode::truncate();
        $csvFile = fopen(base_path('database/csv/currency_codes.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                CurrencyCode::create([
                    'id'         => $data['0'],
                    'country_id' => $data['1'],
                    'name'       => $data['2'],
                    'code'       => $data['3'],
                    'user_id'    => $data['4'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
