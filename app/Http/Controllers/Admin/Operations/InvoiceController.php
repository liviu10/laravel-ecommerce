<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\InvoiceInterface;
use App\Http\Requests\Admin\Operations\InvoiceRequest;

class InvoiceController extends Controller
{
    protected InvoiceInterface $invoiceService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(InvoiceInterface $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->invoiceService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  InvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        return $this->invoiceService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->invoiceService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  InvoiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        return $this->invoiceService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->invoiceService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->invoiceService->handleRestoreRecord($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->invoiceService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->invoiceService->handleFilterTableColumn($request);
    }
}
