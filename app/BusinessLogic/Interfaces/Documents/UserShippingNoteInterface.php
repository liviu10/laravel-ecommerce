<?php

namespace App\BusinessLogic\Interfaces\Documents;

/**
 * UserShippingNoteInterface is a contract for what methods will be used in the UserShippingNoteService class.
 * This consists of the following CRUD operations methods:
 * - handleShow();
 */
interface UserShippingNoteInterface
{
    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);
}
