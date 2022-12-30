<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AcceptedDomainSeeder::class,
            AccountSeeder::class,
            AccountTypeSeeder::class,
            CitySeeder::class,
            CompanySeeder::class,
            CompanyDetailsSeeder::class,
            CountrySeeder::class,
            CountySeeder::class,
            CurrencyCodeSeeder::class,
            DocumentTypeSeeder::class,
            ErrorAndNotificationSeeder::class,
            ListOfEconomicActivitiesSeeder::class,
            NewsletterCampaignSeeder::class,
            ProductTypeSeeder::class,
            UnitOfMeasurementSeeder::class,
            UserRoleTypeSeeder::class,
            UserSeeder::class,
            VatTypeSeeder::class,
            WarehouseTypeSeeder::class,
        ]);
    }
}
