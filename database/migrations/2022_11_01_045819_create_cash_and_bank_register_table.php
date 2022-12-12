<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('document_note');
            $table->decimal('sum_received', 18, 4);
            $table->decimal('sum_payed', 18, 4);
            $table->string('is_cash_register')->default('0');
            $table->string('is_bank_register')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
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
