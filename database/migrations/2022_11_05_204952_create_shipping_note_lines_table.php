<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateShippingNoteLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_note_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_note_id')->index('idx_shipping_note_id');
            $table->foreignId('product_id')->index('idx_shipping_note_lines_product_id');
            $table->string('name');
            $table->foreignId('unit_of_measurement_id')->index('idx_shipping_note_lines_unit_of_measurement_id');
            $table->integer('quantity');
            $table->decimal('unit_gross_value', 18, 4);
            $table->foreignId('vat_type_id')->index('idx_shipping_note_lines_vat_type_id');
            $table->decimal('vat_amount_value', 18, 4);
            $table->decimal('unit_net_value', 18, 4);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_note_lines`
            ADD CONSTRAINT `fk_shipping_note_id`
                FOREIGN KEY (`shipping_note_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`shipping_notes` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_note_lines`
            ADD CONSTRAINT `fk_shipping_note_lines_product_id`
                FOREIGN KEY (`product_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`products` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_note_lines`
            ADD CONSTRAINT `fk_shipping_note_lines_unit_of_measurement_id`
                FOREIGN KEY (`unit_of_measurement_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`unit_of_measurements` (`id`)
                ON DELETE RESTRICT
                ON UPDATE CASCADE;' .
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`shipping_note_lines`
            ADD CONSTRAINT `fk_shipping_note_lines_vat_type_id`
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
        Schema::dropIfExists('shipping_note_lines');
    }
}
