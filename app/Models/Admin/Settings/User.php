<?php

namespace App\Models\Admin\Settings;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\ApiLogError;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ApiLogError;

    /**
     * The primary key associated with the table.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'user_role_type_id';
    
    /**
     * The data type of the database table foreign key.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'user_role_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * Eloquent relationship between users and accepted domains.
     *
     */
    public function accepted_domains()
    {
        return $this->hasMany('App\Models\Admin\Settings\AcceptedDomain');
    }

    /**
     * Eloquent relationship between users and errors and notifications.
     *
     */
    public function errors_and_notifications()
    {
        return $this->hasMany('App\Models\Admin\Settings\ErrorAndNotification');
    }

    /**
     * Eloquent relationship between users and accepted domains.
     *
     */
    public function account_types()
    {
        return $this->hasMany('App\Models\Admin\Configurations\AccountType');
    }

    /**
     * Eloquent relationship between users and cities.
     *
     */
    public function cities()
    {
        return $this->hasMany('App\Models\Admin\Configurations\City');
    }

    /**
     * Eloquent relationship between users and companies.
     *
     */
    public function companies()
    {
        return $this->hasMany('App\Models\Admin\Configurations\Company');
    }

    /**
     * Eloquent relationship between users and company details.
     *
     */
    public function company_details()
    {
        return $this->hasMany('App\Models\Admin\Configurations\CompanyDetails');
    }

    /**
     * Eloquent relationship between users and companies settings.
     *
     */
    public function company_settings()
    {
        return $this->hasMany('App\Models\Admin\Configurations\CompanySettings');
    }

    /**
     * Eloquent relationship between users and countries.
     *
     */
    public function countries()
    {
        return $this->hasMany('App\Models\Admin\Configurations\Country');
    }

    /**
     * Eloquent relationship between users and counties.
     *
     */
    public function counties()
    {
        return $this->hasMany('App\Models\Admin\Configurations\County');
    }

    /**
     * Eloquent relationship between users and document types.
     *
     */
    public function document_types()
    {
        return $this->hasMany('App\Models\Admin\Configurations\DocumentType');
    }

    /**
     * Eloquent relationship between users and list of economic activities.
     *
     */
    public function list_of_economic_activities()
    {
        return $this->hasMany('App\Models\Admin\Configurations\ListOfEconomicActivities');
    }

    /**
     * Eloquent relationship between users and product types.
     *
     */
    public function product_types()
    {
        return $this->hasMany('App\Models\Admin\Configurations\ProductType');
    }

    /**
     * Eloquent relationship between users and unit of measurement.
     *
     */
    public function unit_of_measurements()
    {
        return $this->hasMany('App\Models\Admin\Configurations\UnitOfMeasurement');
    }

    /**
     * Eloquent relationship between users and vat types.
     *
     */
    public function vat_types()
    {
        return $this->hasMany('App\Models\Admin\Configurations\VatType');
    }

    /**
     * Eloquent relationship between users and warehouse types.
     *
     */
    public function warehouse_types()
    {
        return $this->hasMany('App\Models\Admin\Configurations\WarehouseType');
    }

    /**
     * Eloquent relationship between users and accounts.
     *
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Admin\Files\Account');
    }

    /**
     * Eloquent relationship between users and clients.
     *
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Admin\Files\Client');
    }

    /**
     * Eloquent relationship between users and products.
     *
     */
    public function products()
    {
        return $this->hasMany('App\Models\Admin\Files\Product');
    }

    /**
     * Eloquent relationship between users and suppliers.
     *
     */
    public function suppliers()
    {
        return $this->hasMany('App\Models\Admin\Files\Supplier');
    }

    /**
     * Eloquent relationship between users and cash and bank register.
     *
     */
    public function cash_and_bank_register()
    {
        return $this->hasMany('App\Models\Admin\Operations\CashAndBankRegister');
    }

    /**
     * Eloquent relationship between users and consumption receipts.
     *
     */
    public function consumption_receipts()
    {
        return $this->hasMany('App\Models\Admin\Operations\ConsumptionReceipt');
    }

    /**
     * Eloquent relationship between users and consumption receipt lines.
     *
     */
    public function consumption_receipt_lines()
    {
        return $this->hasMany('App\Models\Admin\Operations\ConsumptionReceiptLine');
    }

    /**
     * Eloquent relationship between users and invoices.
     *
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Admin\Operations\Invoice');
    }

    /**
     * Eloquent relationship between users and invoice lines.
     *
     */
    public function invoice_lines()
    {
        return $this->hasMany('App\Models\Admin\Operations\InvoiceLine');
    }

    /**
     * Eloquent relationship between users and sales invoices.
     *
     */
    public function sales_invoices()
    {
        return $this->hasMany('App\Models\Admin\Operations\SaleInvoice');
    }

    /**
     * Eloquent relationship between users and sales invoice lines.
     *
     */
    public function sales_invoice_lines()
    {
        return $this->hasMany('App\Models\Admin\Operations\SaleInvoiceLine');
    }

    /**
     * Eloquent relationship between users and shipping notes.
     *
     */
    public function shipping_notes()
    {
        return $this->hasMany('App\Models\Admin\Operations\ShippingNote');
    }

    /**
     * Eloquent relationship between users and shipping notes lines.
     *
     */
    public function shipping_note_lines()
    {
        return $this->hasMany('App\Models\Admin\Operations\ShippingNoteLine');
    }

    /**
     * Eloquent relationship between users and user role types.
     *
     */
    public function user_role_type()
    {
        return $this->belongsTo('App\Models\Admin\Settings\UserRoleType');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select('id', 'name', 'nickname', 'email')->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to save a single record in the database.
     * @param  array  $payload
     * @return  Bool
     */
    public function createRecord($payload)
    {
        try
        {
            $this->create([
                'name'              => $payload['name'],
                'nickname'          => $payload['nickname'],
                'email'             => $payload['email'],
                'password'          => $payload['password'],
                'user_role_type_id' => $payload['user_role_type_id'],
            ]);

            return True;
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to fetch a single record from the database.
     * @param  int  $id
     * @return  Collection|Bool
     */
    public function fetchSingleRecord($id)
    {
        try
        {
            return $this->select('*')
                        ->where('id', '=', $id)
                        ->with([
                            'user_role_type' => function ($query) {
                                $query->select('id', 'user_role_name', 'user_role_description', 'user_role_slug', 'user_role_is_active');
                            }
                        ])
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to update a single record in the database.
     * @param  array  $payload
     * @param  int  $id
     * @return  Bool
     */
    public function updateRecord($payload, $id)
    {
        try
        {
            $this->find($id)->update([
                'name'              => $payload['name'],
                'nickname'          => $payload['nickname'],
                'email'             => $payload['email'],
                'password'          => $payload['password'],
                'user_role_type_id' => $payload['user_role_type_id'],
            ]);
    
            return True;
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to order records in ascending or descending order.
     * @param  array  $payload
     * @return  Collection|Bool
     */
    public function orderTableColumn($payload)
    {
        try
        {
            return $this->select('id', 'name', 'nickname', 'email')
                        ->orderBy($payload['column_name'], $payload['order_type'])
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to filter the database table.
     * @param  array  $payload
     * @return  Collection|Bool
     */
    public function filterTableColumn($payload)
    {
        try
        {
            if ($payload['column_name'] === 'type')
            {
                return $this->select('id', 'name', 'nickname', 'email')
                            ->where($payload['column_name'], 'LIKE', $payload['filter_value'])
                            ->get();
            }
            else
            {
                return $this->select('id', 'name', 'nickname', 'email')
                            ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                            ->get();
            }
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }
}
