<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('list_of_economic_activities_id')->index('idx_list_of_economic_activities_id');
            $table->string('name')->unique('name');
            $table->string('fiscal_code', 12)->unique('fiscal_code');
            $table->string('registration_number', 20)->unique('registration_number');
            $table->decimal('social_capital', 18, 4);
            $table->foreignId('user_id')->index('idx_companies_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`companies`
            ADD CONSTRAINT `fk_list_of_economic_activities_id`
                FOREIGN KEY (`list_of_economic_activities_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`list_of_economic_activities` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`companies` 
            ADD CONSTRAINT `fk_companies_user_id`
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
        Schema::dropIfExists('companies');
    }
}
