<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('code', 10)->unique('code');
            $table->string('name');
            $table->foreignId('unit_of_measurement_id')->index('idx_unit_of_measurement_id');
            $table->foreignId('vat_type_id')->index('idx_vat_type_id');
            $table->foreignId('product_type_id')->index('idx_product_type_id');
            $table->decimal('sales_price', 18, 4);
            $table->decimal('sales_price_with_vat', 18, 4);
            $table->string('barcode', 13)->unique('barcode');
            $table->timestamps();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`products`
            ADD CONSTRAINT `fk_unit_of_measurement_id`
                FOREIGN KEY (`unit_of_measurement_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`unit_of_measurements` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`products`
            ADD CONSTRAINT `fk_vat_type_id`
                FOREIGN KEY (`vat_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`vat_types` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`products`
            ADD CONSTRAINT `fk_product_type_id`
                FOREIGN KEY (`product_type_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`product_types` (`id`)
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
        Schema::dropIfExists('products');
    }
}
