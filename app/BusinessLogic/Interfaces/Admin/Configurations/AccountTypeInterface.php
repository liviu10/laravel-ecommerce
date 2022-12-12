<?php

namespace App\BusinessLogic\Interfaces\Admin\Configurations;

/**
 * AccountTypeInterface is a contract for what methods will be used in the AccountTypeService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 */
interface AccountTypeInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();
}
