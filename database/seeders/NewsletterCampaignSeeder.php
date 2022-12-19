<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Connect\NewsletterCampaign;
use Carbon\Carbon;

class NewsletterCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        NewsletterCampaign::truncate();
        $records = [
            [
                'id'                   => 1,
                "campaign_name"        => "General newsletter campaign",
                "campaign_description" => "This is a general newsletter campaign which will always be active. User will automatically subscribe to this campaign if no other newsletter campaign is active.",
                "campaign_is_active"   => "1",
                "valid_from"           => "2022-01-01 00:00:00",
                "valid_to"             => "2099-12-31 11:59:59",
                "occur_times"          => 1,
                "occur_week"           => 2,
                "occur_day"            => 3,
                "occur_hour"           => "19:00",
                "user_id"              => 1,
                'created_at'           => Carbon::now(),
                'updated_at'           => Carbon::now(),
            ],
        ];
        NewsletterCampaign::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}