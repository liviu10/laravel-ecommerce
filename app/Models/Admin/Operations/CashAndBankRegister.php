<?php

namespace App\Models\Admin\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class CashAndBankRegister extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cash_and_bank_register';

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
        'document_date',
        'document_number',
        'document_note',
        'sum_received',
        'sum_payed',
        'is_cash_register',
        'is_bank_register',
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
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'is_cash_register' => false,
        'is_bank_register' => false,
    ];

    /**
     * Scoped queries. Is cash register
     *
     */
    public function scopeIsCashRegister ($query) 
    {
        return $query->where('is_cash_register', true);
    }

    /**
     * Scoped queries. Is bank register
     *
     */
    public function scopeIsBankRegister ($query) 
    {
        return $query->where('is_bank_register', false);
    }

    /**
     * Eloquent relationship between cash and bank register and users.
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
            return $this->select(
                            'id', 'document_date', 'document_number',
                            'document_note', 'sum_received', 'sum_payed',
                            'is_cash_register', 'is_bank_register', 'user_id'
                        )
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
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
                'document_date'    => $payload['document_date'],
                'document_number'  => $payload['document_number'],
                'document_note'    => $payload['document_note'],
                'sum_received'     => $payload['sum_received'],
                'sum_payed'        => $payload['sum_payed'],
                'is_cash_register' => $payload['is_cash_register'],
                'is_bank_register' => $payload['is_bank_register'],
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
                'document_date'    => $payload['document_date'],
                'document_number'  => $payload['document_number'],
                'document_note'    => $payload['document_note'],
                'sum_received'     => $payload['sum_received'],
                'sum_payed'        => $payload['sum_payed'],
                'is_cash_register' => $payload['is_cash_register'],
                'is_bank_register' => $payload['is_bank_register'],
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
                            'id', 'document_date', 'document_number',
                            'document_note', 'sum_received', 'sum_payed',
                            'is_cash_register', 'is_bank_register', 'user_id'
                        )
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
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
            return $this->select(
                            'id', 'document_date', 'document_number',
                            'document_note', 'sum_received', 'sum_payed',
                            'is_cash_register', 'is_bank_register', 'user_id'
                        )
                        ->with([
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
                            }
                        ])
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
