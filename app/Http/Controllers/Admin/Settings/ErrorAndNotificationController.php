<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Settings\ErrorAndNotificationInterface;
use App\Http\Requests\Admin\Settings\ErrorAndNotificationRequest;

class ErrorAndNotificationController extends Controller
{
    protected ErrorAndNotificationInterface $errorAndNotificationService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ErrorAndNotificationInterface $errorAndNotificationService)
    {
        $this->errorAndNotificationService = $errorAndNotificationService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->errorAndNotificationService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ErrorAndNotificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ErrorAndNotificationRequest $request)
    {
        return $this->errorAndNotificationService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->errorAndNotificationService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ErrorAndNotificationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ErrorAndNotificationRequest $request, $id)
    {
        return $this->errorAndNotificationService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->errorAndNotificationService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->errorAndNotificationService->handleFilterTableColumn($request);
    }
}
