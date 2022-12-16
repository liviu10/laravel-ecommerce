<?php

namespace App\Models\Admin\Configurations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class CompanyDetails extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'company_details';

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
    protected $foreignKey = 'company_id';

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
    protected $countryForeignKey = 'country_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $countryForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $countyForeignKey = 'county_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $countyForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $cityForeignKey = 'city_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $cityForeignKeyType = 'int';

    /**
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'company_id',
        'country_id',
        'county_id',
        'city_id',
        'address',
        'bank_name',
        'bank_account',
        'phone',
        'email_address',
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
     * Eloquent relationship between company_details and company.
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\Company');
    }

    /**
     * Eloquent relationship between company_details and countries.
     *
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\Country');
    }

    /**
     * Eloquent relationship between company_details and counties.
     *
     */
    public function county()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\County');
    }

    /**
     * Eloquent relationship between company_details and cities.
     *
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\City');
    }

    /**
     * Eloquent relationship between company details and users.
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
                'company_id'    => $payload['company_id'],
                'country_id'    => $payload['country_id'],
                'county_id'     => $payload['county_id'],
                'city_id'       => $payload['city_id'],
                'address'       => $payload['address'],
                'bank_name'     => $payload['bank_name'],
                'bank_account'  => $payload['bank_account'],
                'phone'         => $payload['phone'],
                'email_address' => $payload['email_address'],
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
                'company_id'    => $payload['company_id'],
                'country_id'    => $payload['country_id'],
                'county_id'     => $payload['county_id'],
                'city_id'       => $payload['city_id'],
                'address'       => $payload['address'],
                'bank_name'     => $payload['bank_name'],
                'bank_account'  => $payload['bank_account'],
                'phone'         => $payload['phone'],
                'email_address' => $payload['email_address'],
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
