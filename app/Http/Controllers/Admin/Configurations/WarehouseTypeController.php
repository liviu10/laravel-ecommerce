<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\WarehouseTypeInterface;
use App\Http\Requests\Admin\Configurations\WarehouseTypeRequest;

class WarehouseTypeController extends Controller
{
    protected WarehouseTypeInterface $vatTypeService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(WarehouseTypeInterface $vatTypeService)
    {
        $this->vatTypeService = $vatTypeService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->vatTypeService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  WarehouseTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseTypeRequest $request)
    {
        return $this->vatTypeService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->vatTypeService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  WarehouseTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseTypeRequest $request, $id)
    {
        return $this->vatTypeService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->vatTypeService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->vatTypeService->handleFilterTableColumn($request);
    }
}
