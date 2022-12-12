<?php

namespace App\Models\Admin\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\ApiLogError;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, ApiLogError;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'invoices';

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
    protected $foreignKey = 'document_type_id';

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
    protected $supplierForeignKey = 'supplier_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $supplierForeignKeyType = 'int';

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
        'document_type_id',
        'document_number',
        'supplier_id',
        'vat_on_cash_received',
        'document_date',
        'document_due_date',
        'gross_value',
        'vat_type_id',
        'net_value',
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
     * The attributes that are mass assignable.
     * 
     * @var string
     */
    protected $attributes = [
        'vat_on_cash_received' => false,
    ];

    /**
     * Scoped queries. Invoice with vat on cash received
     *
     */
    public function scopeIsInvoiceWithVatOnCashReceived ($query) 
    {
        return $query->where('vat_on_cash_received', true);
    }

    /**
     * Scoped queries. Invoice without vat on cash received
     *
     */
    public function scopeIsInvoiceWithoutCashOnReceived ($query) 
    {
        return $query->where('vat_on_cash_received', false);
    }

    /**
     * Eloquent relationship between invoices and document_types.
     *
     */
    public function document_type()
    {
        return $this->belongsTo('App\Models\Configurations\DocumentType');
    }

    /**
     * Eloquent relationship between invoices and suppliers.
     *
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Files\Supplier');
    }

    /**
     * Eloquent relationship between invoices and vat_types.
     *
     */
    public function vat_type()
    {
        return $this->belongsTo('App\Models\Configurations\VatType');
    }

    /**
     * Eloquent relationship between invoices and invoice_lines.
     *
     */
    public function invoice_lines()
    {
        return $this->hasMany('App\Models\Operations\InvoiceLine');
    }

    /**
     * Eloquent relationship between invoices and consumption_receipts.
     *
     */
    public function consumption_receipts()
    {
        return $this->hasOne('App\Models\Operations\ConsumptionReceipt');
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
                            'id', 'document_type_id', 'document_number',
                            'supplier_id', 'vat_on_cash_received',
                            'document_date', 'document_due_date',
                            'gross_value', 'vat_type_id', 'net_value',
                        )
                        ->with([
                            'document_type' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'supplier' => function ($query) {
                                $query->select('id', 'name');
                            },
                            'vat_type' => function ($query) {
                                $query->select('id', 'name');
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
                'document_type_id'     => $payload['document_type_id'],
                'document_number'      => $payload['document_number'],
                'supplier_id'          => $payload['supplier_id'],
                'vat_on_cash_received' => $payload['vat_on_cash_received'],
                'document_date'        => $payload['document_date'],
                'document_due_date'    => $payload['document_due_date'],
                'gross_value'          => $payload['gross_value'],
                'vat_type_id'          => $payload['vat_type_id'],
                'net_value'            => $payload['net_value'],
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
        return $this->select(
                        'id', 'document_type_id', 'document_number',
                        'supplier_id', 'vat_on_cash_received',
                        'document_date', 'document_due_date',
                        'gross_value', 'vat_type_id', 'net_value',
                    )
                    ->with([
                        'document_type' => function ($query) {
                            $query->select('id', 'code', 'name');
                        },
                        'supplier' => function ($query) {
                            $query->select('id', 'name');
                        },
                        'vat_type' => function ($query) {
                            $query->select('id', 'name');
                        },
                        'invoice_lines' => function ($query) {
                            $query->select(
                                        'id', 'invoice_id', 'product_type_id',
                                        'warehouse_type_id', 'product_id',
                                        'name', 'unit_of_measurement_id',
                                        'vat_type_id', 'quantity', 'unit_gross_value',
                                        'discount', 'vat_amount_value',
                                        'account_id', 'unit_net_value'
                                    )->with([
                                        'product_type' => function ($query) {
                                            $query->select('id', 'name');
                                        },
                                        'warehouse_type' => function ($query) {
                                            $query->select('id', 'code', 'name', 'type');
                                        },
                                        'unit_of_measurement' => function ($query) {
                                            $query->select('id', 'code', 'name');
                                        },
                                        'vat_type' => function ($query) {
                                            $query->select('id', 'code', 'name', 'value');
                                        },
                                        'account' => function ($query) {
                                            $query->select('id', 'account_type_id', 'code', 'name')->with([
                                                'account_type' => function ($query) {
                                                    $query->select('id', 'code', 'name');
                                                }
                                            ]);
                                        }
                                    ]);
                        },
                        'consumption_receipts' => function ($query) {
                            $query->select(
                                        'id', 'document_number', 'document_date',
                                        'warehouse_type_id', 'invoice_id', 'gross_value',
                                        'vat_type_id', 'net_value'
                                    )->with([
                                        'warehouse_type' => function ($query) {
                                            $query->select('id', 'code', 'name', 'type');
                                        }
                                    ]);
                        },
                    ])
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
                'document_type_id'     => $payload['document_type_id'],
                'document_number'      => $payload['document_number'],
                'supplier_id'          => $payload['supplier_id'],
                'vat_on_cash_received' => $payload['vat_on_cash_received'],
                'document_date'        => $payload['document_date'],
                'document_due_date'    => $payload['document_due_date'],
                'gross_value'          => $payload['gross_value'],
                'vat_type_id'          => $payload['vat_type_id'],
                'net_value'            => $payload['net_value'],
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
                            'id', 'document_type_id', 'document_number',
                            'supplier_id', 'vat_on_cash_received',
                            'document_date', 'document_due_date',
                            'gross_value', 'vat_type_id', 'net_value',
                        )
                        ->with([
                            'document_type' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'supplier' => function ($query) {
                                $query->select('id', 'name');
                            },
                            'vat_type' => function ($query) {
                                $query->select('id', 'name');
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
                            'id', 'document_type_id', 'document_number',
                            'supplier_id', 'vat_on_cash_received',
                            'document_date', 'document_due_date',
                            'gross_value', 'vat_type_id', 'net_value',
                        )
                        ->with([
                            'document_type' => function ($query) {
                                $query->select('id', 'code', 'name');
                            },
                            'supplier' => function ($query) {
                                $query->select('id', 'name');
                            },
                            'vat_type' => function ($query) {
                                $query->select('id', 'name');
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