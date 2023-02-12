<?php

namespace App\BusinessLogic\Services\Admin\Operations;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Operations\ConsumptionReceiptLineInterface;
use App\Http\Requests\Admin\Operations\ConsumptionReceiptLineRequest;
use App\Models\Admin\Operations\ConsumptionReceiptLine;
use Illuminate\Database\Eloquent\Collection;

/**
 * ConsumptionReceiptLineService is a service class the will implement all the methods from the ConsumptionReceiptLineInterface contract and will handle the business logic.
 */
class ConsumptionReceiptLineService implements ConsumptionReceiptLineInterface
{
    use ApiResponseMessage;

    protected $modelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new ConsumptionReceiptLine();
    }

    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex()
    {
        $apiDisplayAllRecords = $this->modelName->fetchAllRecords();

        if ($apiDisplayAllRecords instanceof Collection)
        {
            if ($apiDisplayAllRecords->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiDisplayAllRecords), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Store a new record in the database.
     * @param  ConsumptionReceiptLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ConsumptionReceiptLineRequest $request)
    {
        $apiInsertRecord = [
            'consumption_receipt_id' => $request->get('consumption_receipt_id'),
            'product_id'             => $request->get('product_id'),
            'name'                   => $request->get('name'),
            'unit_of_measurement_id' => $request->get('unit_of_measurement_id'),
            'quantity'               => $request->get('quantity'),
            'unit_gross_value'       => $request->get('unit_gross_value'),
            'vat_type_id'            => $request->get('vat_type_id'),
            'vat_amount_value'       => $request->get('vat_amount_value'),
            'unit_net_value'         => $request->get('unit_net_value'),
            'user_id'                => 1,
        ];
        $saveRecord = $this->modelName->createRecord($apiInsertRecord);

        if ($saveRecord === true)
        {
            return response($this->handleResponse('success'), 201);
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  ConsumptionReceiptLineRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ConsumptionReceiptLineRequest $request, $id)
    {
        $apiUpdateRecord = [
            'consumption_receipt_id' => $request->get('consumption_receipt_id'),
            'product_id'             => $request->get('product_id'),
            'name'                   => $request->get('name'),
            'unit_of_measurement_id' => $request->get('unit_of_measurement_id'),
            'quantity'               => $request->get('quantity'),
            'unit_gross_value'       => $request->get('unit_gross_value'),
            'vat_type_id'            => $request->get('vat_type_id'),
            'vat_amount_value'       => $request->get('vat_amount_value'),
            'unit_net_value'         => $request->get('unit_net_value'),
            'user_id'                => 1,
        ];
        $updateRecord = $this->modelName->updateRecord($apiUpdateRecord, $id);

        if ($updateRecord === true)
        {
            return response($this->handleResponse('success'), 200);
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Delete a single record from the database
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleDestroy($id)
    {
        $apiDisplaySingleRecord = $this->modelName->fetchSingleRecord($id);

        if ($apiDisplaySingleRecord instanceof Collection)
        {
            if ($apiDisplaySingleRecord->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                $this->modelName->deleteRecord($id);
                return response($this->handleResponse('success'), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Restore a single record from the database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleRestoreRecord($id)
    {
        $apiDisplaySingleRecord = $this->modelName->fetchSingleRecord($id);

        if ($apiDisplaySingleRecord instanceof Collection)
        {
            if ($apiDisplaySingleRecord->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                $this->modelName->restoreRecord($id);
                return response($this->handleResponse('success'), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }
}