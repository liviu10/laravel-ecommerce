<?php

namespace App\BusinessLogic\Services\Admin\Configurations;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyDetailsInterface;
use App\Http\Requests\Admin\Configurations\CompanyDetailsRequest;
use App\Models\Admin\Configurations\CompanyDetails;
use Illuminate\Database\Eloquent\Collection;

/**
 * CompanyDetailsService is a service class the will implement all the methods from the CompanyDetailsInterface contract and will handle the business logic.
 */
class CompanyDetailsService implements CompanyDetailsInterface
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
        $this->modelName = new CompanyDetails();
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
     * @param  CompanyDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CompanyDetailsRequest $request)
    {
        $apiInsertRecord = [
            'company_id'    => $request->get('company_id'),
            'country_id'    => $request->get('country_id'),
            'county_id'     => $request->get('county_id'),
            'city_id'       => $request->get('city_id'),
            'address'       => $request->get('address'),
            'bank_name'     => $request->get('bank_name'),
            'bank_account'  => $request->get('bank_account'),
            'phone'         => $request->get('phone'),
            'email_address' => $request->get('email_address'),
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
     * @param  CompanyDetailsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CompanyDetailsRequest $request, $id)
    {
        $apiUpdateRecord = [
            'company_id'    => $request->get('company_id'),
            'country_id'    => $request->get('country_id'),
            'county_id'     => $request->get('county_id'),
            'city_id'       => $request->get('city_id'),
            'address'       => $request->get('address'),
            'bank_name'     => $request->get('bank_name'),
            'bank_account'  => $request->get('bank_account'),
            'phone'         => $request->get('phone'),
            'email_address' => $request->get('email_address'),
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