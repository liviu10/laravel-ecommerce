<?php

namespace App\BusinessLogic\Services\Admin\Operations;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Operations\CashAndBankRegisterInterface;
use App\Http\Requests\Admin\Operations\CashAndBankRegisterRequest;
use App\Models\Admin\Operations\CashAndBankRegister;
use Illuminate\Database\Eloquent\Collection;

/**
 * CashAndBankRegisterService is a service class the will implement all the methods from the CashAndBankRegisterInterface contract and will handle the business logic.
 */
class CashAndBankRegisterService implements CashAndBankRegisterInterface
{
    use ApiResponseMessage;

    protected $modelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new CashAndBankRegister();
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
     * @param  CashAndBankRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CashAndBankRegisterRequest $request)
    {
        $apiInsertRecord = [
            'document_date'    => $request->get('document_date'),
            'document_number'  => $request->get('document_number'),
            'document_note'    => $request->get('document_note'),
            'sum_received'     => $request->get('sum_received'),
            'sum_payed'        => $request->get('sum_payed'),
            'is_cash_register' => $request->get('is_cash_register'),
            'is_bank_register' => $request->get('is_bank_register'),
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
     * @param  CashAndBankRegisterRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CashAndBankRegisterRequest $request, $id)
    {
        $apiUpdateRecord = [
            'document_date'    => $request->get('document_date'),
            'document_number'  => $request->get('document_number'),
            'document_note'    => $request->get('document_note'),
            'sum_received'     => $request->get('sum_received'),
            'sum_payed'        => $request->get('sum_payed'),
            'is_cash_register' => $request->get('is_cash_register'),
            'is_bank_register' => $request->get('is_bank_register'),
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
     * Order all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleOrderTableColumn($request)
    {
        $orderTableColumnPayload = [
            'column_name' => $request->get('column_name'),
            'order_type'  => $request->get('order_type')
        ];
        $apiOrderAllRecords = $this->modelName->orderTableColumn($orderTableColumnPayload);

        if ($apiOrderAllRecords instanceof Collection)
        {
            if ($apiOrderAllRecords->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiOrderAllRecords), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Filter all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleFilterTableColumn($request)
    {
        $filterTableColumnPayload = [
            'column_name'  => $request->get('column_name'),
            'filter_value' => $request->get('filter_value')
        ];
        $apiFilterAllRecords = $this->modelName->filterTableColumn($filterTableColumnPayload);

        if ($apiFilterAllRecords instanceof Collection)
        {
            if ($apiFilterAllRecords->isEmpty())
            {
                return response($this->handleResponse('not_found'), 404);
            }
            else
            {
                return response($this->handleResponse('success', $apiFilterAllRecords), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }
}