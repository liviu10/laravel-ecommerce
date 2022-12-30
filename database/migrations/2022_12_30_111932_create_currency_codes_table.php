<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCurrencyCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_codes', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('country_id')->index('idx_currency_codes_country_id')->comment('The id of the associated country');
            $table->string('name');
            $table->string('code', 3)->comment('The ISO code of the used currency');
            $table->foreignId('user_id')->index('idx_currency_codes_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`currency_codes` 
            ADD CONSTRAINT `fk_currency_codes_country_id`
                FOREIGN KEY (`country_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`countries` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`currency_codes`
            ADD CONSTRAINT `fk_currency_codes_user_id`
                FOREIGN KEY (`user_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`users` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_codes');
    }
}
