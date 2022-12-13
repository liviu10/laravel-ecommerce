<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('company_id')->index('idx_settings_company_id');
            $table->string('name')->comment('The company settings');
            $table->foreignId('user_id')->index('idx_company_settings_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`company_settings`
            ADD CONSTRAINT `fk_settings_company_id`
                FOREIGN KEY (`company_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`companies` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`company_settings` 
            ADD CONSTRAINT `fk_company_settings_user_id`
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
        Schema::dropIfExists('company_settings');
    }
}
