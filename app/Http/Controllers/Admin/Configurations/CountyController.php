<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\CountyInterface;
use App\Http\Requests\Admin\Configurations\CountyRequest;

class CountyController extends Controller
{
    protected CountyInterface $countyService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(CountyInterface $countyService)
    {
        $this->countyService = $countyService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->countyService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  CountyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountyRequest $request)
    {
        return $this->countyService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->countyService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  CountyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountyRequest $request, $id)
    {
        return $this->countyService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->countyService->handleDestroy($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->countyService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->countyService->handleFilterTableColumn($request);
    }
}
