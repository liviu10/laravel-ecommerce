<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Import application's configurations
    use App\BusinessLogic\Interfaces\Admin\Configurations\AccountTypeInterface;
    use App\BusinessLogic\Services\Admin\Configurations\AccountTypeService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CityInterface;
    use App\BusinessLogic\Services\Admin\Configurations\CityService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyInterface;
    use App\BusinessLogic\Services\Admin\Configurations\CompanyService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyDetailsInterface;
    use App\BusinessLogic\Services\Admin\Configurations\CompanyDetailsService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CompanySettingsInterface;
    use App\BusinessLogic\Services\Admin\Configurations\CompanySettingsService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CountryInterface;
    use App\BusinessLogic\Services\Admin\Configurations\CountryService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\CountyInterface;
    use App\BusinessLogic\Services\Admin\Configurations\CountyService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\DocumentTypeInterface;
    use App\BusinessLogic\Services\Admin\Configurations\DocumentTypeService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\ListOfEconomicActivitiesInterface;
    use App\BusinessLogic\Services\Admin\Configurations\ListOfEconomicActivitiesService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\ProductTypeInterface;
    use App\BusinessLogic\Services\Admin\Configurations\ProductTypeService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\UnitOfMeasurementInterface;
    use App\BusinessLogic\Services\Admin\Configurations\UnitOfMeasurementService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\VatTypeInterface;
    use App\BusinessLogic\Services\Admin\Configurations\VatTypeService;
    use App\BusinessLogic\Interfaces\Admin\Configurations\WarehouseTypeInterface;
    use App\BusinessLogic\Services\Admin\Configurations\WarehouseTypeService;

// Import application's files
    use App\BusinessLogic\Interfaces\Admin\Files\AccountInterface;
    use App\BusinessLogic\Services\Admin\Files\AccountService;
    use App\BusinessLogic\Interfaces\Admin\Files\ClientInterface;
    use App\BusinessLogic\Services\Admin\Files\ClientService;
    use App\BusinessLogic\Interfaces\Admin\Files\ProductInterface;
    use App\BusinessLogic\Services\Admin\Files\ProductService;
    use App\BusinessLogic\Interfaces\Admin\Files\SupplierInterface;
    use App\BusinessLogic\Services\Admin\Files\SupplierService;

// Import application's operations
    use App\BusinessLogic\Interfaces\Admin\Operations\CashAndBankRegisterInterface;
    use App\BusinessLogic\Services\Admin\Operations\CashAndBankRegisterService;
    use App\BusinessLogic\Interfaces\Admin\Operations\ConsumptionReceiptInterface;
    use App\BusinessLogic\Services\Admin\Operations\ConsumptionReceiptService;
    use App\BusinessLogic\Interfaces\Admin\Operations\InvoiceInterface;
    use App\BusinessLogic\Services\Admin\Operations\InvoiceService;
    use App\BusinessLogic\Interfaces\Admin\Operations\SaleInvoiceInterface;
    use App\BusinessLogic\Services\Admin\Operations\SaleInvoiceService;
    use App\BusinessLogic\Interfaces\Admin\Operations\ShippingNoteInterface;
    use App\BusinessLogic\Services\Admin\Operations\ShippingNoteService;

// Import application's settings
    use App\BusinessLogic\Interfaces\Admin\Settings\AcceptedDomainInterface;
    use App\BusinessLogic\Services\Admin\Settings\AcceptedDomainService;
    use App\BusinessLogic\Interfaces\Admin\Settings\ErrorAndNotificationInterface;
    use App\BusinessLogic\Services\Admin\Settings\ErrorAndNotificationService;
    use App\BusinessLogic\Interfaces\Admin\Settings\UserInterface;
    use App\BusinessLogic\Services\Admin\Settings\UserService;
    use App\BusinessLogic\Interfaces\Admin\Settings\UserRoleTypeInterface;
    use App\BusinessLogic\Services\Admin\Settings\UserRoleTypeService;

// Import application's contact
    use App\BusinessLogic\Interfaces\Admin\Connect\ContactMeInterface;
    use App\BusinessLogic\Services\Admin\Connect\ContactMeService;
    use App\BusinessLogic\Interfaces\Admin\Connect\ContactMeResponseInterface;
    use App\BusinessLogic\Services\Admin\Connect\ContactMeResponseService;
    use App\BusinessLogic\Interfaces\Admin\Connect\NewsletterCampaignInterface;
    use App\BusinessLogic\Services\Admin\Connect\NewsletterCampaignService;
    use App\BusinessLogic\Interfaces\Admin\Connect\NewsletterSubscriberInterface;
    use App\BusinessLogic\Services\Admin\Connect\NewsletterSubscriberService;


class BusinessLogicProvider extends ServiceProvider
{
    /**
     * Register services.
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

        // Register application's contact and newsletter interfaces and services
        $this->app->bind( ContactMeInterface::class, ContactMeService::class );
        $this->app->bind( ContactMeResponseInterface::class, ContactMeResponseService::class );
        $this->app->bind( NewsletterCampaignInterface::class, NewsletterCampaignService::class );
        $this->app->bind( NewsletterSubscriberInterface::class, NewsletterSubscriberService::class );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
