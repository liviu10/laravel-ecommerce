<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('document_type_id')->index('idx_invoice_document_type_id');
            $table->string('document_number', 23)->unique('document_number');
            $table->foreignId('supplier_id')->index('idx_invoice_supplier_id');
            $table->string('vat_on_cash_received')->default('0');
            $table->dateTime('document_date');
            $table->dateTime('document_due_date');
            $table->decimal('gross_value', 18, 4);
            $table->foreignId('vat_type_id')->index('idx_invoice_vat_type_id');
            $table->decimal('net_value', 18, 4);
            $table->foreignId('user_id')->index('idx_invoices_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoices`
            ADD CONSTRAINT `fk_invoice_document_type_id`
                FOREIGN KEY (`document_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`document_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoices`
            ADD CONSTRAINT `fk_invoice_supplier_id`
                FOREIGN KEY (`supplier_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`suppliers` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoices`
            ADD CONSTRAINT `fk_invoice_vat_type_id`
                FOREIGN KEY (`vat_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`vat_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoices` 
            ADD CONSTRAINT `fk_invoices_user_id`
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
        Schema::dropIfExists('invoices');
    }
}
