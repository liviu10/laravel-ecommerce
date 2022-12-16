<?php

namespace App\Models\Admin\Files;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class Supplier extends Model
{
    use HasFactory, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'suppliers';

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
    protected $foreignKey = 'account_id';

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
        'name',
        'fiscal_code',
        'registration_number',
        'account_id',
        'country_id',
        'county_id',
        'city_id',
        'address',
        'bank_name',
        'bank_account',
        'phone',
        'email_address',
        'is_active',
        'user_id'
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
     * Scoped queries. Supplier is active
     *
     */
    public function scopeIsActive ($query) 
    {
        return $query->where('is_active', true);
    }

    /**
     * Scoped queries. Supplier is not active
     *
     */
    public function scopeIsNotActive ($query) 
    {
        return $query->where('is_active', false);
    }

    /**
     * Eloquent relationship between suppliers and account_types.
     *
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Files\Account');
    }

    /**
     * Eloquent relationship between suppliers and countries.
     *
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Configurations\Country');
    }

    /**
     * Eloquent relationship between suppliers and counties.
     *
     */
    public function county()
    {
        return $this->belongsTo('App\Models\Configurations\County');
    }

    /**
     * Eloquent relationship between suppliers and cities.
     *
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Configurations\City');
    }

    /**
     * Eloquent relationship between suppliers and invoices.
     *
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Operations\Invoice');
    }

    /**
     * Eloquent relationship between suppliers and users.
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
                            'id', 'name', 'fiscal_code',
                            'registration_number', 'is_active', 'user_id'
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
                'name'                => $payload['name'],
                'fiscal_code'         => $payload['fiscal_code'],
                'registration_number' => $payload['registration_number'],
                'account_id'          => $payload['account_id'],
                'country_id'          => $payload['country_id'],
                'county_id'           => $payload['county_id'],
                'city_id'             => $payload['city_id'],
                'address'             => $payload['address'],
                'bank_name'           => $payload['bank_name'],
                'bank_account'        => $payload['bank_account'],
                'phone'               => $payload['phone'],
                'email_address'       => $payload['email_address'],
                'is_active'           => $payload['is_active'],
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
                            'account' => function ($query) {
                                $query->select('id', 'code');
                            },
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
                'name'                => $payload['name'],
                'fiscal_code'         => $payload['fiscal_code'],
                'registration_number' => $payload['registration_number'],
                'account_id'          => $payload['account_id'],
                'country_id'          => $payload['country_id'],
                'county_id'           => $payload['county_id'],
                'city_id'             => $payload['city_id'],
                'address'             => $payload['address'],
                'bank_name'           => $payload['bank_name'],
                'bank_account'        => $payload['bank_account'],
                'phone'               => $payload['phone'],
                'email_address'       => $payload['email_address'],
                'is_active'           => $payload['is_active'],
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
                            'id', 'name', 'fiscal_code',
                            'registration_number', 'is_active', 'user_id'
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
            if ($payload['column_name'] === 'name')
            {
                return $this->select(
                                'id', 'name', 'fiscal_code',
                                'registration_number', 'is_active', 'user_id'
                            )
                            ->with([
                                'user' => function ($query) {
                                    $query->select('id', 'name', 'nickname');
                                }
                            ])
                            ->where($payload['column_name'], 'LIKE', '%' . $payload['filter_value'] . '%')
                            ->get();
            }
            elseif ($payload['column_name'] === 'fiscal_code' || $payload['column_name'] === 'registration_number')
            {
                return $this->select(
                                'id', 'name', 'fiscal_code',
                                'registration_number', 'is_active', 'user_id'
                            )
                            ->with([
                                'user' => function ($query) {
                                    $query->select('id', 'name', 'nickname');
                                }
                            ])
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
