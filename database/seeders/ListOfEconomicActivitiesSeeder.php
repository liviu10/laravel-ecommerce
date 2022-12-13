<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\ListOfEconomicActivities;
use Carbon\Carbon;

class ListOfEconomicActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        ListOfEconomicActivities::truncate();
        $csvFile = fopen(base_path('database/csv/list_of_economic_activities.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                ListOfEconomicActivities::create([
                    'id'      => $data['0'],
                    'code'    => $data['1'],
                    'name'    => $data['2'],
                    'user_id' => $data['3'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
