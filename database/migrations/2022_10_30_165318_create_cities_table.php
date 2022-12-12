<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('county_id')->index('idx_county_id');
            $table->string('siruta_code');
            $table->string('name');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('google_maps_url');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`cities` 
            ADD CONSTRAINT `fk_county_id`
                FOREIGN KEY (`county_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`counties` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
