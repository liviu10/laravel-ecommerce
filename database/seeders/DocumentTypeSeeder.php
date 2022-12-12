<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Configurations\DocumentType;
use Carbon\Carbon;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DocumentType::truncate();
        $records = [
            [
                'id'         => 1,
                'code'       => 'FAC',
                'name'       => 'Factura',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 2,
                'code'       => 'BC',
                'name'       => 'Bon de consum',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id'         => 3,
                'code'       => 'AIM',
                'name'       => 'Aviz de insotire a marfii',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DocumentType::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
