<?php

namespace App\BusinessLogic\Interfaces\Admin\Operations;

use App\Http\Requests\Admin\Operations\ShippingNoteRequest;

/**
 * ShippingNoteInterface is a contract for what methods will be used in the ShippingNotesService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleShow();
 * - handleUpdate();
 * - handleDelete();
 * - handleRestore();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface ShippingNoteInterface
{
    /**
     * This function is specific for displaying all the resources from the database by handling all the HTTP requests [ GET ].
     * 
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * This function is specific for storing a resource in the database by handling all the HTTP request [ POST ].
     * 
     * @param App\Http\Requests\Configurations\ShippingNoteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(ShippingNoteRequest $request);

    /**
     * This function is specific for displaying a single resource from the database by handling all the HTTP request [ GET ].
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);

    /**
     * This function is specific for updating a resource from the database by handling all the HTTP request [ PUT ].
     * 
     * @param App\Http\Requests\Configurations\ShippingNoteRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(ShippingNoteRequest $request, $id);

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

    /**
     * Order all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleOrderTableColumn($request);

    /**
     * Filter all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleFilterTableColumn($request);
}
