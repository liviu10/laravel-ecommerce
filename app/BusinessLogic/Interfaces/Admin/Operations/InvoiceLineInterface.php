<?php

namespace App\BusinessLogic\Interfaces\Admin\Operations;

use App\Http\Requests\Admin\Operations\InvoiceLineRequest;

/**
 * InvoiceLineInterface is a contract for what methods will be used in the InvoiceLineService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleUpdate();
 * - handleDestroy();
 * - handleRestoreRecord();
 */
interface InvoiceLineInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Operations\InvoiceLineRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(InvoiceLineRequest $request);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Operations\InvoiceLineRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(InvoiceLineRequest $request, $id);

    /**
     * Delete a single record from the database
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleDestroy($id);

    /**
     * Restore a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleRestoreRecord($id);
}
