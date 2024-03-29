<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    // Import application's configurations
    use App\Http\Controllers\Admin\Configurations\AccountTypeController;
    use App\Http\Controllers\Admin\Configurations\CountryController;
    use App\Http\Controllers\Admin\Configurations\CountyController;
    use App\Http\Controllers\Admin\Configurations\CityController;
    use App\Http\Controllers\Admin\Configurations\CompanyController;
    use App\Http\Controllers\Admin\Configurations\CompanyDetailsController;
    use App\Http\Controllers\Admin\Configurations\CompanySettingsController;
    use App\Http\Controllers\Admin\Configurations\CurrencyCodeController;
    use App\Http\Controllers\Admin\Configurations\DocumentTypeController;
    use App\Http\Controllers\Admin\Configurations\ListOfEconomicActivitiesController;
    use App\Http\Controllers\Admin\Configurations\ProductTypeController;
    use App\Http\Controllers\Admin\Configurations\UnitOfMeasurementController;
    use App\Http\Controllers\Admin\Configurations\VatTypeController;
    use App\Http\Controllers\Admin\Configurations\WarehouseTypeController;

    // Import application's files
    use App\Http\Controllers\Admin\Files\AccountController;
    use App\Http\Controllers\Admin\Files\ClientController;
    use App\Http\Controllers\Admin\Files\ProductController;
    use App\Http\Controllers\Admin\Files\SupplierController;

    // Import application's operations
    use App\Http\Controllers\Admin\Operations\CashAndBankRegisterController;
    use App\Http\Controllers\Admin\Operations\ConsumptionReceiptController;
    use App\Http\Controllers\Admin\Operations\ConsumptionReceiptLineController;
    use App\Http\Controllers\Admin\Operations\InvoiceController;
    use App\Http\Controllers\Admin\Operations\InvoiceLineController;
    use App\Http\Controllers\Admin\Operations\SaleInvoiceController;
    use App\Http\Controllers\Admin\Operations\SaleInvoiceLineController;
    use App\Http\Controllers\Admin\Operations\ShippingNoteController;
    use App\Http\Controllers\Admin\Operations\ShippingNoteLineController;

    // Import application's settings
    use App\Http\Controllers\Admin\Settings\AcceptedDomainController;
    use App\Http\Controllers\Admin\Settings\ErrorAndNotificationController;
    use App\Http\Controllers\Admin\Settings\UserController;
    use App\Http\Controllers\Admin\Settings\UserRoleTypeController;

    // Import application's contact and newsletter
    use App\Http\Controllers\Admin\Connect\ContactMeController;
    use App\Http\Controllers\Admin\Connect\ContactMeResponseController;
    use App\Http\Controllers\Admin\Connect\NewsletterCampaignController;
    use App\Http\Controllers\Admin\Connect\NewsletterSubscriberController;


Route::group([ 'prefix' => config('app.version') ], function () {
    // Application's admin api endpoints
    Route::group([ 'prefix' => '/admin' ], function () {
        // Application's configurations api endpoints
        Route::group([ 'prefix' => '/configurations' ], function () {
            // Account types
            Route::apiResource('/account-types', AccountTypeController::class)->only('index');
            // Geography
            Route::group([ 'prefix' => '/geography' ], function () {
                // Countries
                Route::group([ 'prefix' => '/countries' ], function () {
                    Route::get('/order', [CountryController::class, 'orderTableColumn']);
                    Route::get('/filter', [CountryController::class, 'filterTableColumn']);
                });
                Route::apiResource('/countries', CountryController::class);
                // Counties
                Route::group([ 'prefix' => '/counties' ], function () {
                    Route::get('/order', [CountyController::class, 'orderTableColumn']);
                    Route::get('/filter', [CountyController::class, 'filterTableColumn']);
                });
                Route::apiResource('/counties', CountyController::class);
                // Cities
                Route::group([ 'prefix' => '/cities' ], function () {
                    Route::get('/order', [CityController::class, 'orderTableColumn']);
                    Route::get('/filter', [CityController::class, 'filterTableColumn']);
                });
                Route::apiResource('/cities', CityController::class);
            });
            // Companies
            Route::group([ 'prefix' => '/company' ], function () {
                Route::get('/restore/{id}', [CompanyController::class, 'restoreRecord']);
                Route::get('/order', [CompanyController::class, 'orderTableColumn']);
                Route::get('/filter', [CompanyController::class, 'filterTableColumn']);
            });
            Route::apiResource('/company', CompanyController::class);
            // Company details
            Route::get('/company-details/restore/{id}', [CompanyDetailsController::class, 'restoreRecord']);
            Route::apiResource('/company-details', CompanyDetailsController::class)->only(['store', 'update', 'destroy']);
            // Company settings
            Route::get('/company-settings/restore/{id}', [CompanySettingsController::class, 'restoreRecord']);
            Route::apiResource('/company-settings', CompanySettingsController::class)->only(['store', 'update', 'destroy']);
            // Currency codes
            Route::group([ 'prefix' => '/currency-codes' ], function () {
                Route::get('/order', [CurrencyCodeController::class, 'orderTableColumn']);
                Route::get('/filter', [CurrencyCodeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/currency-codes', CurrencyCodeController::class);
            // Document types
            Route::group([ 'prefix' => '/document-types' ], function () {
                Route::get('/order', [DocumentTypeController::class, 'orderTableColumn']);
                Route::get('/filter', [DocumentTypeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/document-types', DocumentTypeController::class)->except('destroy');
            // Economic activities
            Route::group([ 'prefix' => '/economic-activities' ], function () {
                Route::get('/order', [ListOfEconomicActivitiesController::class, 'orderTableColumn']);
                Route::get('/filter', [ListOfEconomicActivitiesController::class, 'filterTableColumn']);
            });
            Route::apiResource('/economic-activities', ListOfEconomicActivitiesController::class)->except('destroy');
            // Product types
            Route::group([ 'prefix' => '/product-types' ], function () {
                Route::get('/order', [ProductTypeController::class, 'orderTableColumn']);
                Route::get('/filter', [ProductTypeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/product-types', ProductTypeController::class)->except('destroy');
            // Unit of measurements
            Route::group([ 'prefix' => '/unit-of-measurements' ], function () {
                Route::get('/order', [UnitOfMeasurementController::class, 'orderTableColumn']);
                Route::get('/filter', [UnitOfMeasurementController::class, 'filterTableColumn']);
            });
            Route::apiResource('/unit-of-measurements', UnitOfMeasurementController::class)->except('destroy');
            // Vat types
            Route::group([ 'prefix' => '/vat-types' ], function () {
                Route::get('/order', [VatTypeController::class, 'orderTableColumn']);
                Route::get('/filter', [VatTypeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/vat-types', VatTypeController::class)->except('destroy');
            // Warehouse types
            Route::group([ 'prefix' => '/warehouse-types' ], function () {
                Route::get('/order', [WarehouseTypeController::class, 'orderTableColumn']);
                Route::get('/filter', [WarehouseTypeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/warehouse-types', WarehouseTypeController::class)->except('destroy');
        });

        // Application's files api endpoints
        Route::group([ 'prefix' => '/files' ], function () {
            // Accounts
            Route::group([ 'prefix' => '/accounts' ], function () {
                Route::get('/order', [AccountController::class, 'orderTableColumn']);
                Route::get('/filter', [AccountController::class, 'filterTableColumn']);
            });
            Route::apiResource('/accounts', AccountController::class)->except('destroy');
            // Clients
            Route::group([ 'prefix' => '/clients' ], function () {
                Route::get('/order', [ClientController::class, 'orderTableColumn']);
                Route::get('/filter', [ClientController::class, 'filterTableColumn']);
            });
            Route::apiResource('/clients', ClientController::class)->except('destroy');
            // Products
            Route::group([ 'prefix' => '/products' ], function () {
                Route::get('/order', [ProductController::class, 'orderTableColumn']);
                Route::get('/filter', [ProductController::class, 'filterTableColumn']);
            });
            Route::apiResource('/products', ProductController::class)->except('destroy');
            // Suppliers
            Route::group([ 'prefix' => '/suppliers' ], function () {
                Route::get('/order', [SupplierController::class, 'orderTableColumn']);
                Route::get('/filter', [SupplierController::class, 'filterTableColumn']);
            });
            Route::apiResource('/suppliers', SupplierController::class)->except('destroy');
        });

        // Application's operations api endpoints
        Route::group([ 'prefix' => '/operations' ], function () {
            // Cash and bank register
            Route::group([ 'prefix' => '/cash-and-bank-register' ], function () {
                Route::get('/order', [CashAndBankRegisterController::class, 'orderTableColumn']);
                Route::get('/filter', [CashAndBankRegisterController::class, 'filterTableColumn']);
            });
            Route::apiResource('/cash-and-bank-register', CashAndBankRegisterController::class)->except(['show', 'destroy']);
            // Consumption receipts
            Route::group([ 'prefix' => '/consumption-receipts' ], function () {
                Route::get('/order', [ConsumptionReceiptController::class, 'orderTableColumn']);
                Route::get('/filter', [ConsumptionReceiptController::class, 'filterTableColumn']);
            });
            Route::apiResource('/consumption-receipts', ConsumptionReceiptController::class)->except('destroy');
            // Consumption receipt lines
            Route::get('/consumption-receipt-lines/restore/{id}', [ConsumptionReceiptLineController::class, 'restoreRecord']);
            Route::apiResource('/consumption-receipt-lines', ConsumptionReceiptLineController::class)->only(['store', 'update']);

            // Invoices
            Route::group([ 'prefix' => '/invoices' ], function () {
                Route::get('/order', [InvoiceController::class, 'orderTableColumn']);
                Route::get('/filter', [InvoiceController::class, 'filterTableColumn']);
            });
            Route::apiResource('/invoices', InvoiceController::class)->except('destroy');
            // Invoice lines
            Route::get('/invoice-lines/restore/{id}', [InvoiceLineController::class, 'restoreRecord']);
            Route::apiResource('/invoice-lines', InvoiceLineController::class)->only(['store', 'update']);

            // Sales invoices
            Route::group([ 'prefix' => '/sales-invoice' ], function () {
                Route::get('/order', [SaleInvoiceController::class, 'orderTableColumn']);
                Route::get('/filter', [SaleInvoiceController::class, 'filterTableColumn']);
            });
            Route::apiResource('/sales-invoices', SaleInvoiceController::class)->except('destroy');
            // Sales invoice lines
            Route::get('/sales-invoice-lines/restore/{id}', [SaleInvoiceController::class, 'restoreRecord']);
            Route::apiResource('/sales-invoice-lines', SaleInvoiceLineController::class)->only(['store', 'update']);

            // Shipping notes
            Route::group([ 'prefix' => '/shipping-notes' ], function () {
                Route::get('/order', [ShippingNoteController::class, 'orderTableColumn']);
                Route::get('/filter', [ShippingNoteController::class, 'filterTableColumn']);
            });
            Route::apiResource('/shipping-notes', ShippingNoteController::class)->except('destroy');
            // Shipping note lines
            Route::get('/shipping-note-lines/restore/{id}', [ShippingNoteController::class, 'restoreRecord']);
            Route::apiResource('/shipping-note-lines', ShippingNoteLineController::class)->only(['store', 'update']);
        });

        // Application's settings api endpoints
        Route::group([ 'prefix' => '/settings' ], function () {
            // Accepted domains
            Route::group([ 'prefix' => '/accepted-domains' ], function () {
                Route::get('/restore/{id}', [AcceptedDomainController::class, 'restoreRecord']);
                Route::get('/order/{columnName?}/{orderType?}', [AcceptedDomainController::class, 'orderTableColumn']);
                Route::get('/filter/{columnName?}/{columnValue?}', [AcceptedDomainController::class, 'filterTableColumn']);
            });
            Route::apiResource('/accepted-domains', AcceptedDomainController::class);
            // Errors and notifications
            Route::group([ 'prefix' => '/errors-and-notifications' ], function () {
                Route::get('/order', [ErrorAndNotificationController::class, 'orderTableColumn']);
                Route::get('/filter', [ErrorAndNotificationController::class, 'filterTableColumn']);
            });
            Route::apiResource('/errors-and-notifications', ErrorAndNotificationController::class)->except('destroy');
            // Users
            Route::group([ 'prefix' => '/users' ], function () {
                Route::get('/order', [UserController::class, 'orderTableColumn']);
                Route::get('/filter', [UserController::class, 'filterTableColumn']);
            });
            Route::apiResource('/users', UserController::class)->except('destroy');
            // User role types
            Route::group([ 'prefix' => '/user-role-types' ], function () {
                Route::get('/order', [UserRoleTypeController::class, 'orderTableColumn']);
                Route::get('/filter', [UserRoleTypeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/user-role-types', UserRoleTypeController::class)->only('index');
        });

        // Application's contact and newsletter
        Route::group([ 'prefix' => '/connect' ], function () {
            // Contact
            Route::group([ 'prefix' => '/contact-me' ], function () {
                Route::get('/restore/{id}', [ContactMeController::class, 'restoreRecord']);
                Route::get('/order', [ContactMeController::class, 'orderTableColumn']);
                Route::get('/filter', [ContactMeController::class, 'filterTableColumn']);
            });
            Route::apiResource('/contact-me', ContactMeController::class); // TODO: move the create method to client routes
            // Contact me response
            Route::group([ 'prefix' => '/contact-me-responses' ], function () {
                Route::get('/restore/{id}', [ContactMeResponseController::class, 'restoreRecord']);
                Route::get('/order', [ContactMeResponseController::class, 'orderTableColumn']);
                Route::get('/filter', [ContactMeResponseController::class, 'filterTableColumn']);
            });
            Route::apiResource('/contact-me-responses', ContactMeResponseController::class);
            // Newsletter campaigns
            Route::group([ 'prefix' => '/newsletter-campaigns' ], function () {
                Route::get('/restore/{id}', [NewsletterCampaignController::class, 'restoreRecord']);
                Route::get('/order', [NewsletterCampaignController::class, 'orderTableColumn']);
                Route::get('/filter', [NewsletterCampaignController::class, 'filterTableColumn']);
            });
            Route::apiResource('/newsletter-campaigns', NewsletterCampaignController::class);
            // Newsletter subscribers
            Route::group([ 'prefix' => '/newsletter-subscribers' ], function () {
                Route::get('/restore/{id}', [NewsletterSubscriberController::class, 'restoreRecord']);
                Route::get('/order', [NewsletterSubscriberController::class, 'orderTableColumn']);
                Route::get('/filter', [NewsletterSubscriberController::class, 'filterTableColumn']);
                Route::delete('/unsubscribe', [NewsletterSubscriberController::class, 'unsubscribeUser']); // TODO: move unsubscribeMethod method to client routes
                Route::get('/unsubscribe/restore', [NewsletterSubscriberController::class, 'restoreSubscription']); // TODO: move restoreSubscription method to client routes
            });
            Route::apiResource('/newsletter-subscribers', NewsletterSubscriberController::class);
        });
    });

    // Application's client api endpoints
    Route::group([ 'prefix' => '/client' ], function () {});
});