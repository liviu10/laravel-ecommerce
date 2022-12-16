<?php

namespace App\Models\Admin\Configurations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class ProductType extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product_types';

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
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'name',
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
     * Eloquent relationship between product_types and products.
     *
     */
    public function products()
    {
        return $this->hasMany('App\Models\Files\Product');
    }

    /**
     * Eloquent relationship between products and invoice_lines.
     *
     */
    public function invoice_lines()
    {
        return $this->hasMany('App\Models\Operations\InvoiceLine');
    }

    /**
     * Eloquent relationship between products and sales_invoice_lines.
     *
     */
    public function sales_invoice_lines()
    {
        return $this->hasMany('App\Models\Operations\SaleInvoiceLine');
    }

    /**
     * Eloquent relationship between product types and users.
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
            return $this->select('id', 'name')->get();
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
                'name' => $payload['name'],
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
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
                            }
                        ])
                        ->where('id', '=', $id)
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
                'name' => $payload['name'],
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
            return $this->select('id', 'name')
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
            return $this->select('id', 'name')
                        ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }
}
