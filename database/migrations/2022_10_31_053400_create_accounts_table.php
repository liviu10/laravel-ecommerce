<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('account_type_id')->index('idx_account_type_id');
            $table->string('code', 36)->unique('code');
            $table->string('name');
            $table->string('is_active')->default('0');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`accounts` 
            ADD CONSTRAINT `fk_account_type_id`
                FOREIGN KEY (`account_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`account_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
