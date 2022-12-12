<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('company_id')->index('idx_details_company_id');
            $table->foreignId('country_id')->index('idx_company_details_country_id');
            $table->foreignId('county_id')->index('idx_company_details_county_id');
            $table->foreignId('city_id')->index('idx_company_details_city_id');
            $table->string('address');
            $table->string('bank_name');
            $table->string('bank_account', 32);
            $table->string('phone', 20);
            $table->string('email_address')->unique('email_address');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`company_details`
            ADD CONSTRAINT `fk_details_company_id`
                FOREIGN KEY (`company_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`companies` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`company_details`
            ADD CONSTRAINT `fk_company_details_country_id`
                FOREIGN KEY (`country_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`countries` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`company_details`
            ADD CONSTRAINT `fk_company_details_county_id`
                FOREIGN KEY (`county_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`counties` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`company_details`
            ADD CONSTRAINT `fk_company_details_city_id`
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
        Schema::dropIfExists('company_details');
    }
}
