<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\UnitOfMeasurementInterface;
use App\Http\Requests\Admin\Configurations\UnitOfMeasurementRequest;

class UnitOfMeasurementController extends Controller
{
    protected UnitOfMeasurementInterface $unitOfMeasurementService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(UnitOfMeasurementInterface $unitOfMeasurementService)
    {
        $this->unitOfMeasurementService = $unitOfMeasurementService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->unitOfMeasurementService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  UnitOfMeasurementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitOfMeasurementRequest $request)
    {
        return $this->unitOfMeasurementService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->unitOfMeasurementService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  UnitOfMeasurementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitOfMeasurementRequest $request, $id)
    {
        return $this->unitOfMeasurementService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->unitOfMeasurementService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->unitOfMeasurementService->handleFilterTableColumn($request);
    }
}
