<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Settings\ErrorAndNotification;
use Carbon\Carbon;

class ErrorAndNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        ErrorAndNotification::truncate();
        $csvFile = fopen(base_path('database/csv/errors_and_notifications.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                ErrorAndNotification::create([
                    'id'                       => $data['0'],
                    'notify_code'              => $data['1'],
                    'notify_short_description' => $data['2'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
