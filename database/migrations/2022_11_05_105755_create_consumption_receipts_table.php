<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConsumptionReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumption_receipts', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('document_type_id')->index('idx_consumption_receipts_document_type_id');
            $table->string('document_number', 23)->unique('document_number');
            $table->dateTime('document_date');
            $table->foreignId('warehouse_type_id')->index('idx_consumption_receipts_warehouse_type_id');
            $table->foreignId('invoice_id')->index('idx_consumption_receipts_invoice_id');
            $table->decimal('gross_value', 18, 4);
            $table->foreignId('vat_type_id')->index('idx_consumption_receipts_vat_type_id');
            $table->decimal('net_value', 18, 4);
            $table->string('document_explications');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`consumption_receipts`
            ADD CONSTRAINT `fk_consumption_receipts_document_type_id`
                FOREIGN KEY (`document_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`document_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`consumption_receipts`
            ADD CONSTRAINT `fk_consumption_receipts_warehouse_type_id`
                FOREIGN KEY (`warehouse_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`warehouse_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`consumption_receipts`
            ADD CONSTRAINT `fk_consumption_receipts_invoice_id`
                FOREIGN KEY (`invoice_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`invoices` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`consumption_receipts`
            ADD CONSTRAINT `fk_consumption_receipts_vat_type_id`
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
        Schema::dropIfExists('consumption_receipts');
    }
}
