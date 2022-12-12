<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\InvoiceLineInterface;
use App\Http\Requests\Admin\Operations\InvoiceLineRequest;

class InvoiceLineController extends Controller
{
    protected InvoiceLineInterface $invoiceLineService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(InvoiceLineInterface $invoiceLineService)
    {
        $this->invoiceLineService = $invoiceLineService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->invoiceLineService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  InvoiceLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceLineRequest $request)
    {
        return $this->invoiceLineService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  InvoiceLineRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceLineRequest $request, $id)
    {
        return $this->invoiceLineService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->invoiceLineService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->invoiceLineService->handleRestoreRecord($id);
    }
}
