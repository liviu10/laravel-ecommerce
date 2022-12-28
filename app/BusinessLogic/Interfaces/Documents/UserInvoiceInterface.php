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
     * Display the user invoice.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function handleDisplayUserInvoice($request);
}
