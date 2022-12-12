<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\ListOfEconomicActivitiesInterface;
use App\Http\Requests\Admin\Configurations\ListOfEconomicActivitiesRequest;

class ListOfEconomicActivitiesController extends Controller
{
    protected ListOfEconomicActivitiesInterface $listOfEconomicActivitiesService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ListOfEconomicActivitiesInterface $listOfEconomicActivitiesService)
    {
        $this->listOfEconomicActivitiesService = $listOfEconomicActivitiesService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->listOfEconomicActivitiesService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ListOfEconomicActivitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListOfEconomicActivitiesRequest $request)
    {
        return $this->listOfEconomicActivitiesService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->listOfEconomicActivitiesService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ListOfEconomicActivitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListOfEconomicActivitiesRequest $request, $id)
    {
        return $this->listOfEconomicActivitiesService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->listOfEconomicActivitiesService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->listOfEconomicActivitiesService->handleFilterTableColumn($request);
    }
}
