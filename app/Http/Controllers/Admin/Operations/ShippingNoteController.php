<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\ShippingNoteInterface;
use App\Http\Requests\Admin\Operations\ShippingNoteRequest;

class ShippingNoteController extends Controller
{
    protected ShippingNoteInterface $shippingNoteService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ShippingNoteInterface $shippingNoteService)
    {
        $this->shippingNoteService = $shippingNoteService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->shippingNoteService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ShippingNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingNoteRequest $request)
    {
        return $this->shippingNoteService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->shippingNoteService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ShippingNoteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingNoteRequest $request, $id)
    {
        return $this->shippingNoteService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->shippingNoteService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->shippingNoteService->handleRestoreRecord($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->shippingNoteService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->shippingNoteService->handleFilterTableColumn($request);
    }
}
