<?php

namespace App\BusinessLogic\Interfaces\Admin\Settings;

use App\Http\Requests\Admin\Settings\UserRoleTypeRequest;

/**
 * UserRoleTypeInterface is a contract for what methods will be used in the UserRoleTypeService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 */
interface UserRoleTypeInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();
}
