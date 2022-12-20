<?php

namespace App\BusinessLogic\Interfaces\Documents;

/**
 * UserReceiptInterface is a contract for what methods will be used in the UserReceiptService class.
 * This consists of the following CRUD operations methods:
 * - handleShow();
 */
interface UserReceiptInterface
{
    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);
}
