<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\SaleInvoiceInterface;
use App\Http\Requests\Admin\Operations\SaleInvoiceRequest;

class SaleInvoiceController extends Controller
{
    protected SaleInvoiceInterface $saleInvoiceService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(SaleInvoiceInterface $saleInvoiceService)
    {
        $this->saleInvoiceService = $saleInvoiceService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->saleInvoiceService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  SaleInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleInvoiceRequest $request)
    {
        return $this->saleInvoiceService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->saleInvoiceService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  SaleInvoiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleInvoiceRequest $request, $id)
    {
        return $this->saleInvoiceService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->saleInvoiceService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->saleInvoiceService->handleRestoreRecord($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->saleInvoiceService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->saleInvoiceService->handleFilterTableColumn($request);
    }
}
