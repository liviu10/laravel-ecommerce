<?php

namespace App\BusinessLogic\Interfaces\Documents;

/**
 * UserWarrantyInterface is a contract for what methods will be used in the UserWarrantyService class.
 * This consists of the following CRUD operations methods:
 * - handleShow();
 */
interface UserWarrantyInterface
{
    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);
}
