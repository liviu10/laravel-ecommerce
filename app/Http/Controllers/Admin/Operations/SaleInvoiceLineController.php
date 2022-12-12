<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\SaleInvoiceLineInterface;
use App\Http\Requests\Admin\Operations\SaleInvoiceLineRequest;

class SaleInvoiceLineController extends Controller
{
    protected SaleInvoiceLineInterface $saleInvoiceLineService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(SaleInvoiceLineInterface $saleInvoiceLineService)
    {
        $this->saleInvoiceLineService = $saleInvoiceLineService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->saleInvoiceLineService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  SaleInvoiceLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleInvoiceLineRequest $request)
    {
        return $this->saleInvoiceLineService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  SaleInvoiceLineRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleInvoiceLineRequest $request, $id)
    {
        return $this->saleInvoiceLineService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->saleInvoiceLineService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->saleInvoiceLineService->handleRestoreRecord($id);
    }
}
