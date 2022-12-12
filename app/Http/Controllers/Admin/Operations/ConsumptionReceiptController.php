<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\ConsumptionReceiptInterface;
use App\Http\Requests\Admin\Operations\ConsumptionReceiptRequest;

class ConsumptionReceiptController extends Controller
{
    protected ConsumptionReceiptInterface $consumptionReceiptService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ConsumptionReceiptInterface $consumptionReceiptService)
    {
        $this->consumptionReceiptService = $consumptionReceiptService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->consumptionReceiptService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ConsumptionReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumptionReceiptRequest $request)
    {
        return $this->consumptionReceiptService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->consumptionReceiptService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ConsumptionReceiptRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumptionReceiptRequest $request, $id)
    {
        return $this->consumptionReceiptService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->consumptionReceiptService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->consumptionReceiptService->handleRestoreRecord($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->consumptionReceiptService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->consumptionReceiptService->handleFilterTableColumn($request);
    }
}
