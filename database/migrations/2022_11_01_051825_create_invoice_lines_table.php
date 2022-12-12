<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->index('idx_invoice_id');
            $table->foreignId('product_type_id')->index('idx_invoice_line_product_type_id');
            $table->foreignId('warehouse_type_id')->index('idx_invoice_line_warehouse_type_id');
            $table->foreignId('product_id')->index('idx_invoice_line_product_id');
            $table->string('name');
            $table->foreignId('unit_of_measurement_id')->index('idx_invoice_line_unit_of_measurement_id');
            $table->foreignId('vat_type_id')->index('idx_invoice_line_vat_type_id');
            $table->integer('quantity');
            $table->decimal('unit_gross_value', 18, 4);
            $table->decimal('discount', 18, 4);
            $table->decimal('vat_amount_value', 18, 4);
            $table->foreignId('account_id')->index('idx_invoice_line_account_id');
            $table->decimal('unit_net_value', 18, 4);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_id`
                FOREIGN KEY (`invoice_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`invoices` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_line_product_type_id`
                FOREIGN KEY (`product_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`product_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_line_warehouse_type_id`
                FOREIGN KEY (`warehouse_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`warehouse_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_line_product_id`
                FOREIGN KEY (`product_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`products` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_line_unit_of_measurement_id`
                FOREIGN KEY (`unit_of_measurement_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`unit_of_measurements` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_line_vat_type_id`
                FOREIGN KEY (`vat_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`vat_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`invoice_lines`
            ADD CONSTRAINT `fk_invoice_line_account_id`
                FOREIGN KEY (`account_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`accounts` (`id`)
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
        Schema::dropIfExists('invoice_lines');
    }
}
