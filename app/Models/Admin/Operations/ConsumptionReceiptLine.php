<?php

namespace App\Models\Admin\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class ConsumptionReceiptLine extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'consumption_receipt_lines';

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
    protected $foreignKey = 'consumption_receipt_id';

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
    protected $productForeignKey = 'product_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $productForeignKeyType = 'int';

    /**
     * The foreign key associated with the table.
     * 
     * @var string
     */
    protected $unitOfMeasurementForeignKey = 'unit_of_measurement_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $unitOfMeasurementForeignKeyType = 'int';

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
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $fillable = [
        'consumption_receipt_id',
        'product_id',
        'name',
        'unit_of_measurement_id',
        'quantity',
        'unit_gross_value',
        'vat_type_id',
        'vat_amount_value',
        'unit_net_value',
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
     * Eloquent relationship between consumption_receipt_lines and consumption_receipts.
     *
     */
    public function consumption_receipt()
    {
        return $this->belongsTo('App\Models\Admin\Operations\ComputedReceipt');
    }

    /**
     * Eloquent relationship between consumption_receipt_lines and products.
     *
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Files\Product');
    }

    /**
     * Eloquent relationship between consumption_receipt_lines and unit_of_measurements.
     *
     */
    public function unit_of_measurement()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\UnitOfMeasurement');
    }

    /**
     * Eloquent relationship between consumption_receipt_lines and vat_types.
     *
     */
    public function vat_type()
    {
        return $this->belongsTo('App\Models\Admin\Configurations\VatType');
    }

    /**
     * Eloquent relationship between consumption receipt lines and users.
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
                'consumption_receipt_id' => $payload['consumption_receipt_id'],
                'product_id'             => $payload['product_id'],
                'name'                   => $payload['name'],
                'unit_of_measurement_id' => $payload['unit_of_measurement_id'],
                'quantity'               => $payload['quantity'],
                'unit_gross_value'       => $payload['unit_gross_value'],
                'vat_type_id'            => $payload['vat_type_id'],
                'vat_amount_value'       => $payload['vat_amount_value'],
                'unit_net_value'         => $payload['unit_net_value'],
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
                'consumption_receipt_id' => $payload['consumption_receipt_id'],
                'product_id'             => $payload['product_id'],
                'name'                   => $payload['name'],
                'unit_of_measurement_id' => $payload['unit_of_measurement_id'],
                'quantity'               => $payload['quantity'],
                'unit_gross_value'       => $payload['unit_gross_value'],
                'vat_type_id'            => $payload['vat_type_id'],
                'vat_amount_value'       => $payload['vat_amount_value'],
                'unit_net_value'         => $payload['unit_net_value'],
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
