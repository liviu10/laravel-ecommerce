<?php

namespace App\BusinessLogic\Interfaces\Documents;

/**
 * UserInvoiceInterface is a contract for what methods will be used in the UserInvoiceService class.
 * This consists of the following CRUD operations methods:
 * - handleShow();
 */
interface UserInvoiceInterface
{
    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);
}
