<?php

namespace App\BusinessLogic\Services\Admin\Settings;

use App\Traits\ApiResponseMessage;
use App\BusinessLogic\Interfaces\Admin\Settings\UserRoleTypeInterface;
use App\Models\Admin\Settings\UserRoleType;
use Illuminate\Database\Eloquent\Collection;

/**
 * UserRoleTypeService is a service class the will implement all the methods from the UserRoleTypeInterface contract and will handle the business logic.
 */
class UserRoleTypeService implements UserRoleTypeInterface
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
        $this->modelName = new UserRoleType();
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
}