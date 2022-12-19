<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNewsletterCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('campaign_name');
            $table->string('campaign_description');
            $table->string('campaign_is_active')->default('0');
            $table->dateTime('valid_from')->comment('The start date and time of the newsletter campaign');
            $table->dateTime('valid_to')->comment('The end date and time of the newsletter campaign');
            $table->integer('occur_times')->comment('The number of occurrences of the newsletter campaign (eg. 3 times)');
            $table->integer('occur_week')->comment('The number of  the week when the newsletter campaign will occur (eg. 2nd week of the month)');
            $table->integer('occur_day')->comment('The number of the week day when the newsletter campaign will occur (eg. 1 for Monday)');
            $table->time('occur_hour')->comment('The hour when the newsletter campaign will occur (eg. 19:00)');
            $table->foreignId('user_id')->index('idx_newsletter_campaigns_user_id')->comment('The id of the user who added this record');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared(
            'ALTER TABLE ' . config('database.connections.mysql.database') . '.`newsletter_campaigns` 
            ADD CONSTRAINT `fk_newsletter_campaigns_user_id`
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
        Schema::dropIfExists('newsletter_campaigns');
    }
}
