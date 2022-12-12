<?php

namespace App\BusinessLogic\Interfaces\Admin\Operations;

use App\Http\Requests\Admin\Operations\ShippingNoteLineRequest;

/**
 * ShippingNoteLineInterface is a contract for what methods will be used in the ShippingNoteLineService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleUpdate();
 * - handleDestroy();
 * - handleRestoreRecord();
 */
interface ShippingNoteLineInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Operations\ShippingNoteLineRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ShippingNoteLineRequest $request);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Operations\ShippingNoteLineRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ShippingNoteLineRequest $request, $id);

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
