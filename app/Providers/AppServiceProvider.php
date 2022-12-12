<?php

namespace App\Providers;

// Import application's configurations
    use App\BusinessLogic\Interfaces\Admin\Configurations\AccountTypeInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CityInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyDetailsInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CompanySettingsInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CountryInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CountyInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\DocumentTypeInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\ListOfEconomicActivitiesInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\ProductTypeInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\UnitOfMeasurementInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\VatTypeInterface;
    use App\BusinessLogic\Interfaces\Admin\Configurations\WarehouseTypeInterface;

// Import application's files
    use App\BusinessLogic\Interfaces\Admin\Files\AccountInterface;
    use App\BusinessLogic\Interfaces\Admin\Files\ClientInterface;
    use App\BusinessLogic\Interfaces\Admin\Files\ProductInterface;
    use App\BusinessLogic\Interfaces\Admin\Files\SupplierInterface;

// Import application's operations
    use App\BusinessLogic\Interfaces\Admin\Operations\CashAndBankRegisterInterface;
    use App\BusinessLogic\Interfaces\Admin\Operations\ConsumptionReceiptInterface;
    use App\BusinessLogic\Interfaces\Admin\Operations\InvoiceInterface;
    use App\BusinessLogic\Interfaces\Admin\Operations\SaleInvoiceInterface;
    use App\BusinessLogic\Interfaces\Admin\Operations\ShippingNoteInterface;

// Import application's settings
    use App\BusinessLogic\Interfaces\Admin\Settings\AcceptedDomainInterface;
    use App\BusinessLogic\Interfaces\Admin\Settings\ErrorAndNotificationInterface;
    use App\BusinessLogic\Interfaces\Admin\Settings\UserInterface;
    use App\BusinessLogic\Interfaces\Admin\Settings\UserRoleTypeInterface;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register application's configurations interfaces and services
        $this->app->bind( AccountTypeInterface::class, AccountTypeService::class );
        $this->app->bind( CityInterface::class, CityService::class );
        $this->app->bind( CompanyInterface::class, CompanyService::class );
        $this->app->bind( CompanyDetailsInterface::class, CompanyDetailsService::class );
        $this->app->bind( CompanySettingsInterface::class, CompanySettingsService::class );
        $this->app->bind( CountryInterface::class, CountryService::class );
        $this->app->bind( CountyInterface::class, CountyService::class );
        $this->app->bind( DocumentTypeInterface::class, DocumentTypeService::class );
        $this->app->bind( ListOfEconomicActivitiesInterface::class, ListOfEconomicActivitiesService::class );
        $this->app->bind( ProductTypeInterface::class, ProductTypeService::class );
        $this->app->bind( UnitOfMeasurementInterface::class, UnitOfMeasurementService::class );
        $this->app->bind( VatTypeInterface::class, VatTypeService::class );
        $this->app->bind( WarehouseTypeInterface::class, WarehouseTypeService::class );

        // Register application's files interfaces and services
        $this->app->bind( AccountInterface::class, AccountService::class );
        $this->app->bind( ClientInterface::class, ClientService::class );
        $this->app->bind( ProductInterface::class, ProductService::class );
        $this->app->bind( SupplierInterface::class, SupplierService::class );

        // Register application's operations interfaces and services
        $this->app->bind( CashAndBankRegisterInterface::class, CashAndBankRegisterService::class );
        $this->app->bind( ConsumptionReceiptInterface::class, ConsumptionReceiptService::class );
        $this->app->bind( InvoiceInterface::class, InvoiceService::class );
        $this->app->bind( SaleInvoiceInterface::class, SaleInvoiceService::class );
        $this->app->bind( ShippingNoteInterface::class, ShippingNoteService::class );

        // Register application's settings interfaces and services
        $this->app->bind( AcceptedDomainInterface::class, AcceptedDomainService::class );
        $this->app->bind( ErrorAndNotificationInterface::class, ErrorAndNotificationService::class );
        $this->app->bind( UserInterface::class, UserService::class );
        $this->app->bind( UserRoleTypeInterface::class, UserRoleTypeService::class );

        // Register laravel telescope
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }
    }
}
