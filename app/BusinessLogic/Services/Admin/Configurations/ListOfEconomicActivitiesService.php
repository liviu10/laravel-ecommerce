<?php

namespace App\BusinessLogic\Services\Admin\Configurations;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Configurations\ListOfEconomicActivitiesInterface;
use App\Http\Requests\Admin\Configurations\ListOfEconomicActivitiesRequest;
use App\Models\Admin\Configurations\ListOfEconomicActivities;
use Illuminate\Database\Eloquent\Collection;

/**
 * ListOfEconomicActivitiesService is a service class the will implement all the methods from the ListOfEconomicActivitiesInterface contract and will handle the business logic.
 */
class ListOfEconomicActivitiesService implements ListOfEconomicActivitiesInterface
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
        $this->modelName = new ListOfEconomicActivities();
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
     * @param  ListOfEconomicActivitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ListOfEconomicActivitiesRequest $request)
    {
        $apiInsertRecord = [
            'code' => $request->get('code'),
            'name' => $request->get('name'),
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
     * @param  ListOfEconomicActivitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ListOfEconomicActivitiesRequest $request, $id)
    {
        $apiUpdateRecord = [
            'code' => $request->get('code'),
            'name' => $request->get('name'),
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