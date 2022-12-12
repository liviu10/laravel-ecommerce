<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\VatTypeInterface;
use App\Http\Requests\Admin\Configurations\VatTypeRequest;

class VatTypeController extends Controller
{
    protected VatTypeInterface $vatTypeService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(VatTypeInterface $vatTypeService)
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
     * @param  VatTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VatTypeRequest $request)
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
     * @param  VatTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VatTypeRequest $request, $id)
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
