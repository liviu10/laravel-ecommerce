<?php

namespace App\Http\Controllers\Admin\Connect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Connect\ContactMeResponseInterface;
use App\Http\Requests\Admin\Connect\ContactMeResponseRequest;

class ContactMeResponseController extends Controller
{
    protected ContactMeResponseInterface $contactMeResponseService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ContactMeResponseInterface $contactMeResponseService)
    {
        $this->contactMeResponseService = $contactMeResponseService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->contactMeResponseService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ContactMeResponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactMeResponseRequest $request)
    {
        return $this->contactMeResponseService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->contactMeResponseService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ContactMeResponseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactMeResponseRequest $request, $id)
    {
        return $this->contactMeResponseService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->contactMeResponseService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->contactMeResponseService->handleRestoreRecord($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->contactMeResponseService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->contactMeResponseService->handleFilterTableColumn($request);
    }
}
