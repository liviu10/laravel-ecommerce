<?php

namespace App\Models\Admin\Connect;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class NewsletterCampaign extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'newsletter_campaigns';

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
    protected $foreignKey = 'user_id';
    
    /**
     * The data type of the database table foreign key.
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
        'campaign_name',
        'campaign_description',
        'campaign_is_active',
        'valid_from',
        'valid_to',
        'occur_times',
        'occur_week',
        'occur_day',
        'occur_hour',
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
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'campaign_is_active' => false,
    ];

    /**
     * Scoped queries. Invoice with vat on cash received
     *
     */
    public function scopeIsCampaignActive ($query) 
    {
        return $query->where('campaign_is_active', true);
    }

    /**
     * Scoped queries. Invoice without vat on cash received
     *
     */
    public function scopeIsNotCampaignActive ($query) 
    {
        return $query->where('campaign_is_active', false);
    }

    /**
     * Eloquent relationship between contact_me and contact_me_responses.
     *
     */
    public function newsletter_subscribers()
    {
        return $this->hasMany('App\Models\Admin\Connect\NewsletterSubscriber');
    }

    /**
     * Eloquent relationship between newsletter_campaigns and users.
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
            return $this->select('id', 'campaign_name', 'campaign_description', 'campaign_is_active')
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
                'campaign_name'        => $payload['campaign_name'],
                'campaign_description' => $payload['campaign_description'],
                'campaign_is_active'   => $payload['campaign_is_active'],
                'valid_from'           => $payload['valid_from'],
                'valid_to'             => $payload['valid_to'],
                'occur_times'          => $payload['occur_times'],
                'occur_week'           => $payload['occur_week'],
                'occur_day'            => $payload['occur_day'],
                'occur_hour'           => $payload['occur_hour'],
                'user_id'              => $payload['user_id'],
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
        return $this->select('*')
                    ->with([
                        'newsletter_subscribers' => function ($query) {
                            $query->select('id', 'newsletter_campaign_id', 'full_name', 'email_address', 'privacy_policy');
                        },
                        'user' => function ($query) {
                            $query->select('id', 'name', 'nickname');
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
                'campaign_name'        => $payload['campaign_name'],
                'campaign_description' => $payload['campaign_description'],
                'campaign_is_active'   => $payload['campaign_is_active'],
                'valid_from'           => $payload['valid_from'],
                'valid_to'             => $payload['valid_to'],
                'occur_times'          => $payload['occur_times'],
                'occur_week'           => $payload['occur_week'],
                'occur_day'            => $payload['occur_day'],
                'occur_hour'           => $payload['occur_hour'],
                'user_id'              => $payload['user_id'],
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
            return $this->select('id', 'campaign_name', 'campaign_description', 'campaign_is_active')
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
            return $this->select('id', 'campaign_name', 'campaign_description', 'campaign_is_active')
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
