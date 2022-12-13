<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Files\Account;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Account::truncate();
        $csvFile = fopen(base_path('database/csv/accounts.csv'), 'r');
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ",")) !== false)
        {
            if (!$firstLine) {
                Account::create([
                    'id'              => $data['0'],
                    'account_type_id' => $data['1'],
                    'code'            => $data['2'],
                    'name'            => $data['3'],
                    'is_active'       => $data['4'],
                    'user_id'         => $data['5'],
                ]);    
            }
            $firstLine = false;
        }
        fclose($csvFile);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
