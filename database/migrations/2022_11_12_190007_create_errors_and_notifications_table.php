<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateErrorsAndNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors_and_notifications', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('notify_code', 10)->unique('notify_code')->index('idx_notify_code');
            $table->string('notify_short_description');
            $table->foreignId('user_id')->index('idx_errors_and_notifications_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`errors_and_notifications` 
            ADD CONSTRAINT `fk_errors_and_notifications_user_id`
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
        Schema::dropIfExists('errors_and_notifications');
    }
}
