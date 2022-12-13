<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateListOfEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_of_economic_activities', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('code', 5)->unique('code')->index('idx_code');
            $table->string('name')->comment('The list of all the economic activities in Romania');
            $table->foreignId('user_id')->index('idx_list_of_economic_activities_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`list_of_economic_activities` 
            ADD CONSTRAINT `fk_list_of_economic_activities_user_id`
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
        Schema::dropIfExists('list_of_economic_activities');
    }
}
