<?php

namespace App\BusinessLogic\Services\Admin\Configurations;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyInterface;
use App\Http\Requests\Admin\Configurations\CompanyRequest;
use App\Models\Admin\Configurations\Company;
use Illuminate\Database\Eloquent\Collection;

/**
 * CompanyService is a service class the will implement all the methods from the CompanyInterface contract and will handle the business logic.
 */
class CompanyService implements CompanyInterface
{
    use ApiResponseMessage;

    protected $modelName;
    protected $tableName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new Company();
        $this->tableName = $this->modelName->getTable();
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
     * @param  CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CompanyRequest $request)
    {
        $apiInsertRecord = [
            'list_of_economic_activities_id' => $request->get('list_of_economic_activities_id'),
            'name'                           => $request->get('name'),
            'fiscal_code'                    => $request->get('fiscal_code'),
            'registration_number'            => $request->get('registration_number'),
            'social_capital'                 => $request->get('social_capital'),
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
     * @param  CompanyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CompanyRequest $request, $id)
    {
        $apiUpdateRecord = [
            'list_of_economic_activities_id' => $request->get('list_of_economic_activities_id'),
            'name'                           => $request->get('name'),
            'fiscal_code'                    => $request->get('fiscal_code'),
            'registration_number'            => $request->get('registration_number'),
            'social_capital'                 => $request->get('social_capital'),
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