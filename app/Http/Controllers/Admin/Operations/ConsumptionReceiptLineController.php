<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\ConsumptionReceiptLineInterface;
use App\Http\Requests\Admin\Operations\ConsumptionReceiptLineRequest;

class ConsumptionReceiptLineController extends Controller
{
    protected ConsumptionReceiptLineInterface $consumptionReceiptLineService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ConsumptionReceiptLineInterface $consumptionReceiptLineService)
    {
        $this->consumptionReceiptLineService = $consumptionReceiptLineService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->consumptionReceiptLineService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ConsumptionReceiptLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumptionReceiptLineRequest $request)
    {
        return $this->consumptionReceiptLineService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ConsumptionReceiptLineRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumptionReceiptLineRequest $request, $id)
    {
        return $this->consumptionReceiptLineService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->consumptionReceiptLineService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->consumptionReceiptLineService->handleRestoreRecord($id);
    }
}
