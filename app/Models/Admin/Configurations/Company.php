<?php

namespace App\Models\Admin\Configurations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class Company extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'companies';

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
     * The foreign key key associated with the table.
     * 
     * @var string
     */
    protected $foreignKey = 'list_of_economic_activities_id';

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
        'list_of_economic_activities_id',
        'name',
        'fiscal_code',
        'registration_number',
        'social_capital',
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
        'deleted_at'
    ];

    /**
     * Eloquent relationship between companies and list_of_economic_activities.
     *
     */
    public function list_of_economic_activities()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\ListOfEconomicActivities');
    }

    /**
     * Eloquent relationship between companies and companies_details.
     *
     */
    public function company_details()
    {
        return $this->hasMany('App\Models\Admin\Configurations\CompanyDetails');
    }

    /**
     * Eloquent relationship between companies and companies_settings.
     *
     */
    public function company_settings()
    {
        return $this->hasMany('App\Models\Admin\Configurations\CompanySettings');
    }

    /**
     * Eloquent relationship between companies and users.
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
                            'id', 'list_of_economic_activities_id',
                            'name', 'fiscal_code', 'registration_number',
                            'social_capital'
                        )
                        ->with([
                            'list_of_economic_activities' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
                            }
                        ])
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
                'list_of_economic_activities_id' => $payload['list_of_economic_activities_id'],
                'name'                           => $payload['name'],
                'fiscal_code'                    => $payload['fiscal_code'],
                'registration_number'            => $payload['registration_number'],
                'social_capital'                 => $payload['social_capital'],
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
            return $this->select('*')->withTrashed()
                        ->where('id', '=', $id)
                        ->with([
                            'list_of_economic_activities' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'company_details' => function ($query) {
                                $query->select(
                                    'id', 'company_id', 'country_id',
                                    'county_id', 'city_id', 'address',
                                    'bank_name', 'bank_account', 'phone',
                                    'email_address', 'created_at', 'updated_at',
                                    'user_id'
                                )->with([
                                    'country' => function ($query) {
                                        $query->select('id', 'name');
                                    },
                                    'county' => function ($query) {
                                        $query->select('id', 'name');
                                    },
                                    'city' => function ($query) {
                                        $query->select('id', 'name');
                                    },
                                    'user' => function ($query) {
                                        $query->select('id', 'name', 'nickname');
                                    }
                                ]);
                            },
                            'company_settings' => function ($query) {
                                $query->select('id', 'company_id', 'name', 'user_id')->with([
                                    'user' => function ($query) {
                                        $query->select('id', 'name', 'nickname');
                                    }
                                ]);
                            },
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
                'list_of_economic_activities_id' => $payload['list_of_economic_activities_id'],
                'name'                           => $payload['name'],
                'fiscal_code'                    => $payload['fiscal_code'],
                'registration_number'            => $payload['registration_number'],
                'social_capital'                 => $payload['social_capital'],
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
            return $this->select(
                            'id', 'list_of_economic_activities_id',
                            'name', 'fiscal_code', 'registration_number',
                            'social_capital', 'user_id'
                        )
                        ->orderBy($payload['column_name'], $payload['order_type'])
                        ->with([
                            'list_of_economic_activities' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
                            }
                        ])
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
            return $this->select(
                            'id', 'list_of_economic_activities_id',
                            'name', 'fiscal_code', 'registration_number',
                            'social_capital', 'user_id'
                        )
                        ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                        ->with([
                            'list_of_economic_activities' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'user' => function ($query) {
                                $query->select('id', 'name', 'nickname');
                            }
                        ])
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
