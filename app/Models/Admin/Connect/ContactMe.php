<?php

namespace App\Models\Admin\Connect;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class ContactMe extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'contact_me';

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
        'full_name',
        'email_address',
        'subject',
        'message',
        'privacy_policy'
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
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'privacy_policy' => false,
    ];

    /**
     * Scoped queries. Invoice with vat on cash received
     *
     */
    public function scopeIsPrivacyPolicy ($query) 
    {
        return $query->where('privacy_policy', true);
    }

    /**
     * Scoped queries. Invoice without vat on cash received
     *
     */
    public function scopeIsNotPrivacyPolicy ($query) 
    {
        return $query->where('privacy_policy', false);
    }

    /**
     * Eloquent relationship between contact_me and contact_me_responses.
     *
     */
    public function contact_me_responses()
    {
        return $this->hasMany('App\Models\Admin\Connect\ContactMeResponse');
    }

    /**
     * SQL query to fetch all records.
     * @return  Collection|Bool
     */
    public function fetchAllRecords()
    {
        try
        {
            return $this->select('id', 'full_name', 'email_address', 'subject', 'privacy_policy')
                        ->withTrashed()
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
                'full_name'      => $payload['full_name'],
                'email_address'  => $payload['email_address'],
                'subject'        => $payload['subject'],
                'message'        => $payload['message'],
                'privacy_policy' => $payload['privacy_policy'],
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
     * SQL queries to fetch invoice details.
     * @param  int  $id
     *
     */
    public function fetchSingleRecord($id): Collection
    {
        return $this->select('*')->with([
                        'contact_me_responses' => function ($query) {
                            $query->select('id', 'contact_me_id', 'message_response', 'user_id')->with([
                                'user' => function ($query) {
                                    $query->select('id', 'name', 'nickname');
                                }
                            ]);
                        }
                    ])
                    ->where('id', '=', $id)
                    ->withTrashed()
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
                'full_name'      => $payload['full_name'],
                'email_address'  => $payload['email_address'],
                'subject'        => $payload['subject'],
                'message'        => $payload['message'],
                'privacy_policy' => $payload['privacy_policy'],
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

    /**
     * SQL query to order records in ascending or descending order.
     * @param  array  $payload
     * @return  Collection|Bool
     */
    public function orderTableColumn($payload)
    {
        try
        {
            return $this->select('id', 'full_name', 'email_address', 'subject', 'privacy_policy')
                        ->orderBy($payload['column_name'], $payload['order_type'])
                        ->withTrashed()
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
            return $this->select('id', 'full_name', 'email_address', 'subject', 'privacy_policy')
                        ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                        ->withTrashed()
                        ->get();
        }
        catch (\Illuminate\Database\QueryException $mysqlError)
        {
            $this->handleApiLogError($mysqlError);
            return False;
        }
    }
}
