<?php

namespace App\Models\Admin\Files;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class Product extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'products';

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
    protected $foreignKey = 'unit_of_measurement_id';

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
    protected $productTypeForeignKey = 'product_type_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $productTypeKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'code',
        'name',
        'unit_of_measurement_id',
        'vat_type_id',
        'product_type_id',
        'sales_price',
        'sales_price_with_vat',
        'barcode',
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
        'updated_at'
    ];

    /**
     * Eloquent relationship between products and unit_of_measurements.
     *
     */
    public function unit_of_measurement()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\UnitOfMeasurement');
    }

    /**
     * Eloquent relationship between products and vat_types.
     *
     */
    public function vat_type()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\VatType');
    }

    /**
     * Eloquent relationship between products and product_types.
     *
     */
    public function product_type()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\ProductType');
    }

    /**
     * Eloquent relationship between products and invoice_lines.
     *
     */
    public function invoice_lines()
    {
        return $this->hasMany('App\Models\Admin\Operations\InvoiceLine');
    }

    /**
     * Eloquent relationship between products and sales_invoice_lines.
     *
     */
    public function sales_invoice_lines()
    {
        return $this->hasMany('App\Models\Admin\Operations\SaleInvoiceLine');
    }

    /**
     * Eloquent relationship between products and users.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\Settings\User');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select('id', 'code', 'name', 'user_id')
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'full_name', 'nickname');
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
     * SQL query to save a single record in the database.
     * @param  array  $payload
     * @return  Bool
     */
    public function createRecord($payload)
    {
        try
        {
            $this->create([
                'code'                   => $payload['code'],
                'name'                   => $payload['name'],
                'unit_of_measurement_id' => $payload['unit_of_measurement_id'],
                'vat_type_id'            => $payload['vat_type_id'],
                'product_type_id'        => $payload['product_type_id'],
                'sales_price'            => $payload['sales_price'],
                'sales_price_with_vat'   => $payload['sales_price_with_vat'],
                'barcode'                => $payload['barcode'],
                'user_id'                => 1,
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
                            'unit_of_measurement' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'vat_type' => function ($query) {
                                $query->select('id', 'code', 'name', 'value');
                            },
                            'product_type' => function ($query) {
                                $query->select('id', 'name');
                            },
                            'user' => function ($query) {
                                $query->select('id', 'full_name', 'nickname');
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
                'code'                   => $payload['code'],
                'name'                   => $payload['name'],
                'unit_of_measurement_id' => $payload['unit_of_measurement_id'],
                'vat_type_id'            => $payload['vat_type_id'],
                'product_type_id'        => $payload['product_type_id'],
                'sales_price'            => $payload['sales_price'],
                'sales_price_with_vat'   => $payload['sales_price_with_vat'],
                'barcode'                => $payload['barcode']
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
            return $this->select('id', 'code', 'name', 'user_id')
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'full_name', 'nickname');
                            }
                        ])
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
            if ($payload['column_name'] === 'code')
            {
                return $this->select('id', 'code', 'name', 'user_id')
                            ->with([
                                'user' => function ($query) {
                                    $query->select('id', 'full_name', 'nickname');
                                }
                            ])
                            ->where($payload['column_name'], 'LIKE', $payload['filter_value'])
                            ->get();
            }
            elseif ($payload['column_name'] === 'name')
            {
                return $this->select('id', 'code', 'name', 'user_id')
                            ->with([
                                'user' => function ($query) {
                                    $query->select('id', 'full_name', 'nickname');
                                }
                            ])
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
