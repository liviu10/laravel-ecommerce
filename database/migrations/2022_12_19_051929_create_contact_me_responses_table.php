<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateContactMeResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_me_responses', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('contact_me_id')->index('idx_contact_me_id');
            $table->string('message_response');
            $table->foreignId('user_id')->index('idx_contact_me_responses_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`contact_me_responses` 
            ADD CONSTRAINT `fk_contact_me_id`
                FOREIGN KEY (`contact_me_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`contact_me` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE;' . 
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`contact_me_responses` 
            ADD CONSTRAINT `fk_contact_me_responses_user_id`
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
        Schema::dropIfExists('contact_me_responses');
    }
}
