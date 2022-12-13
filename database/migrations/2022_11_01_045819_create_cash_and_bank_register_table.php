<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCashAndBankRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_and_bank_register', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->dateTime('document_date');
            $table->string('document_number', 23)->unique('document_number');
            $table->string('document_note')->comment('Notes to keep track of all the acquisitions and sales payed with cash or bank.');
            $table->decimal('sum_received', 18, 4);
            $table->decimal('sum_payed', 18, 4);
            $table->string('is_cash_register')->default('0');
            $table->string('is_bank_register')->default('0');
            $table->foreignId('user_id')->index('idx_cash_and_bank_register_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`cash_and_bank_register` 
            ADD CONSTRAINT `fk_cash_and_bank_register_user_id`
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
        Schema::dropIfExists('cash_and_bank_register');
    }
}
