<?php

namespace App\Models\Admin\Configurations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class County extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'counties';

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
    protected $foreignKey = 'country_id';

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
        'country_id',
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
     * Eloquent relationship between counties and countries.
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Configurations\Country');
    }

    /**
     * Eloquent relationship between counties and cities.
     *
     */
    public function cities()
    {
        return $this->hasMany('App\Models\Configurations\City');
    }

    /**
     * Eloquent relationship between counties and company_details.
     *
     */
    public function company_details()
    {
        return $this->hasMany('App\Models\Configurations\CompanyDetails');
    }

    /**
     * Eloquent relationship between counties and clients.
     *
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Files\Client');
    }

    /**
     * Eloquent relationship between countries and suppliers.
     *
     */
    public function suppliers()
    {
        return $this->hasMany('App\Models\Files\Supplier');
    }

    /**
     * Eloquent relationship between counties and users.
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
                'country_id' => $payload['country_id'],
                'name'       => $payload['name'],
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
            return $this->select('id', 'name')
                        ->where('id', '=', $id)
                        ->with([
                            'cities' => function ($query) {
                                $query->select('id', 'county_id', 'name');
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
                'country_id' => $payload['country_id'],
                'name'       => $payload['name'],
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
