<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateShippingNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_notes', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('document_type_id')->index('idx_shipping_notes_document_type_id');
            $table->string('document_number', 23)->unique('document_number');
            $table->dateTime('document_date');
            $table->foreignId('warehouse_type_id')->index('idx_shipping_notes_warehouse_type_id');
            $table->foreignId('sales_invoice_id')->index('idx_shipping_notes_invoice_id');
            $table->decimal('gross_value', 18, 4);
            $table->foreignId('vat_type_id')->index('idx_shipping_notes_vat_type_id');
            $table->decimal('net_value', 18, 4);
            $table->string('document_explications');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_notes`
            ADD CONSTRAINT `fk_shipping_notes_document_type_id`
                FOREIGN KEY (`document_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`document_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_notes`
            ADD CONSTRAINT `fk_shipping_notes_warehouse_type_id`
                FOREIGN KEY (`warehouse_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`warehouse_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_notes`
            ADD CONSTRAINT `fk_shipping_notes_invoice_id`
                FOREIGN KEY (`sales_invoice_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`sales_invoices` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_notes`
            ADD CONSTRAINT `fk_shipping_notes_vat_type_id`
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
        Schema::dropIfExists('shipping_notes');
    }
}
