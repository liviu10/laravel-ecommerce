<?php

namespace App\Models\Admin\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class InvoiceLine extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'invoice_lines';

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
    protected $foreignKey = 'invoice_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $productTypeForeignKey = 'product_type_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $productTypeForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $warehouseTypeForeignKey = 'warehouse_type_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $warehouseTypeForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $productForeignKey = 'product_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $productForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $unitOfMeasurementForeignKey = 'unit_of_measurement_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $unitOfMeasurementForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $vatTypeForeignKey = 'vat_type_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $vatTypeForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $accountForeignKey = 'account_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $accountForeignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'invoice_id',
        'product_type_id',
        'warehouse_type_id',
        'product_id',
        'name',
        'unit_of_measurement_id',
        'vat_type_id',
        'quantity',
        'unit_gross_value',
        'discount',
        'vat_amount_value',
        'account_id',
        'unit_net_value',
        'user_id'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'delete_at'
    ];

    /**
     * Eloquent relationship between invoice_lines and invoices.
     *
     */
    public function invoice()
    {
        return $this->belongsTo('App\Models\Admin\Operations\Invoice');
    }

    /**
     * Eloquent relationship between invoice_lines and product_types.
     *
     */
    public function product_type()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\ProductType');
    }

    /**
     * Eloquent relationship between invoice_lines and warehouse_types.
     *
     */
    public function warehouse_type()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\WarehouseType');
    }

    /**
     * Eloquent relationship between invoice_lines and products.
     *
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Files\Product');
    }

    /**
     * Eloquent relationship between invoice_lines and unit_of_measurements.
     *
     */
    public function unit_of_measurement()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\UnitOfMeasurement');
    }

    /**
     * Eloquent relationship between invoice_lines and vat_types.
     *
     */
    public function vat_type()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\VatType');
    }

    /**
     * Eloquent relationship between invoice_lines and accounts.
     *
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Admin\Files\Account');
    }

    /**
     * Eloquent relationship between invoice lines and users.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\Settings\User');
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
                'invoice_id'             => $payload['invoice_id'],
                'product_type_id'        => $payload['product_type_id'],
                'warehouse_type_id'      => $payload['warehouse_type_id'],
                'product_id'             => $payload['product_id'],
                'name'                   => $payload['name'],
                'unit_of_measurement_id' => $payload['unit_of_measurement_id'],
                'vat_type_id'            => $payload['vat_type_id'],
                'quantity'               => $payload['quantity'],
                'unit_gross_value'       => $payload['unit_gross_value'],
                'discount'               => $payload['discount'],
                'vat_amount_value'       => $payload['vat_amount_value'],
                'account_id'             => $payload['account_id'],
                'unit_net_value'         => $payload['unit_net_value'],
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
     * SQL queries to fetch company details by id.
     * @param  int  $id
     *
     */
    public function fetchSingleRecord($id): Collection
    {
        return $this->select('*')
                    ->with([
                        'user' => function ($query) {
                            $query->select('id', 'name', 'nickname');
                        }
                    ])
                    ->withTrashed()
                    ->where('id', '=', $id)
                    ->get();
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
                'invoice_id'             => $payload['invoice_id'],
                'product_type_id'        => $payload['product_type_id'],
                'warehouse_type_id'      => $payload['warehouse_type_id'],
                'product_id'             => $payload['product_id'],
                'name'                   => $payload['name'],
                'unit_of_measurement_id' => $payload['unit_of_measurement_id'],
                'vat_type_id'            => $payload['vat_type_id'],
                'quantity'               => $payload['quantity'],
                'unit_gross_value'       => $payload['unit_gross_value'],
                'discount'               => $payload['discount'],
                'vat_amount_value'       => $payload['vat_amount_value'],
                'account_id'             => $payload['account_id'],
                'unit_net_value'         => $payload['unit_net_value'],
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
     * SQL query to delete a record from the database.
     * @param  int  $id
     * @return  Bool
     */
    public function deleteRecord($id)
    {
        try
        {
            $this->find($id)->delete();

            return True;
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }

    /**
     * SQL query to restore a record from the database.
     * @param  int  $id
     * @return  Bool
     */
    public function restoreRecord($id)
    {
        try
        {
            $this->withTrashed()->find($id)->restore();
    
            return True;
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }
}
