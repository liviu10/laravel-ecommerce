<?php

namespace App\BusinessLogic\Services\Admin\Files;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Files\ClientInterface;
use App\Http\Requests\Admin\Files\ClientRequest;
use App\Models\Admin\Files\Client;
use Illuminate\Database\Eloquent\Collection;

/**
 * ClientService is a service class the will implement all the methods from the ClientInterface contract and will handle the business logic.
 */
class ClientService implements ClientInterface
{
    use ApiResponseMessage;

    protected $modelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new Client();
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
     * @param  ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ClientRequest $request)
    {
        $apiInsertRecord = [
            'name'                => $request->get('name'),
            'fiscal_code'         => $request->get('fiscal_code'),
            'registration_number' => $request->get('registration_number'),
            'account_id'          => $request->get('account_id'),
            'country_id'          => $request->get('country_id'),
            'county_id'           => $request->get('county_id'),
            'city_id'             => $request->get('city_id'),
            'address'             => $request->get('address'),
            'bank_name'           => $request->get('bank_name'),
            'bank_account'        => $request->get('bank_account'),
            'phone'               => $request->get('phone'),
            'email_address'       => $request->get('email_address'),
            'is_active'           => $request->get('is_active'),
            'user_id'             => 1,
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
     * Fetch a single record from the database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id)
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
                return response($this->handleResponse('success', $apiDisplaySingleRecord), 200);
            }
        }
        else
        {
            return response($this->handleResponse('error_message'), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ClientRequest $request, $id)
    {
        $apiUpdateRecord = [
            'name'                => $request->get('name'),
            'fiscal_code'         => $request->get('fiscal_code'),
            'registration_number' => $request->get('registration_number'),
            'account_id'          => $request->get('account_id'),
            'country_id'          => $request->get('country_id'),
            'county_id'           => $request->get('county_id'),
            'city_id'             => $request->get('city_id'),
            'address'             => $request->get('address'),
            'bank_name'           => $request->get('bank_name'),
            'bank_account'        => $request->get('bank_account'),
            'phone'               => $request->get('phone'),
            'email_address'       => $request->get('email_address'),
            'is_active'           => $request->get('is_active'),
            'user_id'             => 1,
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