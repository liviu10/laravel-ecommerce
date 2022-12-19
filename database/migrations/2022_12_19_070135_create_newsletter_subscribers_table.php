<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNewsletterSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->foreignId('newsletter_campaign_id')->index('idx_newsletter_campaign_id');
            $table->string('full_name');
            $table->string('email_address')->unique('email_address');
            $table->string('privacy_policy')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`newsletter_subscribers` 
            ADD CONSTRAINT `fk_newsletter_campaign_id`
                FOREIGN KEY (`newsletter_campaign_id`)
                REFERENCES ' . config('database.connections.mysql.database') . '.`newsletter_campaigns` (`id`)
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
        Schema::dropIfExists('newsletter_subscribers');
    }
}
