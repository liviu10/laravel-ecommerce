<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\DocumentTypeInterface;
use App\Http\Requests\Admin\Configurations\DocumentTypeRequest;

class DocumentTypeController extends Controller
{
    protected DocumentTypeInterface $documentTypeService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(DocumentTypeInterface $documentTypeService)
    {
        $this->documentTypeService = $documentTypeService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->documentTypeService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  DocumentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeRequest $request)
    {
        return $this->documentTypeService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->documentTypeService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  DocumentTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypeRequest $request, $id)
    {
        return $this->documentTypeService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->documentTypeService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->documentTypeService->handleFilterTableColumn($request);
    }
}
