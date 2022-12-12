<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('name');
            $table->string('fiscal_code', 12)->unique('fiscal_code');
            $table->string('registration_number', 20)->unique('registration_number');
            $table->foreignId('account_id')->index('idx_client_account_id');
            $table->foreignId('country_id')->index('idx_client_country_id');
            $table->foreignId('county_id')->index('idx_client_county_id');
            $table->foreignId('city_id')->index('idx_client_city_id');
            $table->string('address');
            $table->string('bank_name');
            $table->string('bank_account', 32);
            $table->string('phone', 20);
            $table->string('email_address')->unique('email_address');
            $table->string('is_active')->default('0');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`clients`
            ADD CONSTRAINT `fk_client_account_id`
                FOREIGN KEY (`account_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`accounts` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`clients`
            ADD CONSTRAINT `fk_client_country_id`
                FOREIGN KEY (`country_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`countries` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`clients`
            ADD CONSTRAINT `fk_client_county_id`
                FOREIGN KEY (`county_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`counties` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`clients`
            ADD CONSTRAINT `fk_client_city_id`
                FOREIGN KEY (`city_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`cities` (`id`)
                ON DELETE RESTRICT
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
        Schema::dropIfExists('clients');
    }
}
