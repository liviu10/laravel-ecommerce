<?php

namespace App\Models\Admin\Files;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class Account extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'accounts';

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
    protected $foreignKey = 'account_type_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $foreignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'account_type_id',
        'code',
        'name',
        'is_active',
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'is_active' => false,
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
     * Scoped queries. Account is active
     *
     */
    public function scopeIsActive ($query) 
    {
        return $query->where('is_active', true);
    }

    /**
     * Scoped queries. Account is not active
     *
     */
    public function scopeIsNotActive ($query) 
    {
        return $query->where('is_active', false);
    }

    /**
     * Eloquent relationship between accounts and account_types.
     *
     */
    public function account_type()
    {
        return $this->belongsTo('App\Models\Configurations\AccountType');
    }

    /**
     * Eloquent relationship between accounts and clients.
     *
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Files\Client');
    }

    /**
     * Eloquent relationship between accounts and suppliers.
     *
     */
    public function suppliers()
    {
        return $this->hasMany('App\Models\Files\Supplier');
    }

    /**
     * Eloquent relationship between accounts and invoice_lines.
     *
     */
    public function invoice_lines()
    {
        return $this->hasMany('App\Models\Operations\InvoiceLine');
    }

    /**
     * Eloquent relationship between accounts and sales_invoice_lines.
     *
     */
    public function sales_invoice_lines()
    {
        return $this->hasMany('App\Models\Operations\SaleInvoiceLine');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select(
                            'id', 'account_type_id', 'code',
                            'name', 'is_active'
                        )
                        ->with([
                            'account_type' => function ($query) {
                                $query->select('id', 'code', 'name');
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
                'account_type_id' => $payload['account_type_id'],
                'code'            => $payload['code'],
                'name'            => $payload['name'],
                'is_active'       => $payload['is_active'],
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
                            'account_type' => function ($query) {
                                $query->select('id', 'code', 'name');
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
                'account_type_id' => $payload['account_type_id'],
                'code'            => $payload['code'],
                'name'            => $payload['name'],
                'is_active'       => $payload['is_active'],
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
            return $this->select(
                            'id', 'account_type_id', 'code',
                            'name', 'is_active'
                        )
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
                return $this->select(
                                'id', 'account_type_id', 'code',
                                'name', 'is_active'
                            )
                            ->where($payload['column_name'], 'LIKE', $payload['filter_value'])
                            ->get();
            }
            elseif ($payload['column_name'] === 'name')
            {
                return $this->select(
                                'id', 'account_type_id', 'code',
                                'name', 'is_active'
                            )
                            ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                            ->get();
            }
            else
            {
                return $this->select(
                                'id', 'account_type_id', 'code',
                                'name', 'is_active'
                            )
                            ->where($payload['column_name'], 'LIKE', $payload['filter_value'])
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
