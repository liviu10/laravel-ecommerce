<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSalesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('document_type_id')->index('idx_sales_invoice_document_type_id');
            $table->string('document_number', 23)->unique('document_number');
            $table->foreignId('client_id')->index('idx_sales_invoice_client_id');
            $table->string('electronic_invoice')->default('0');
            $table->dateTime('document_date');
            $table->dateTime('document_due_date');
            $table->decimal('gross_value', 18, 4);
            $table->foreignId('vat_type_id')->index('idx_sales_invoice_vat_type_id');
            $table->decimal('net_value', 18, 4);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`sales_invoices`
            ADD CONSTRAINT `fk_sales_invoice_document_type_id`
                FOREIGN KEY (`document_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`document_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`sales_invoices`
            ADD CONSTRAINT `fk_sales_invoice_client_id`
                FOREIGN KEY (`client_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`suppliers` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`sales_invoices`
            ADD CONSTRAINT `fk_sales_invoice_vat_type_id`
                FOREIGN KEY (`vat_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`vat_types` (`id`)
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
        Schema::dropIfExists('sales_invoices');
    }
}
