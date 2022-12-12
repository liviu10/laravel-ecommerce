<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\CompanyDetailsInterface;
use App\Http\Requests\Admin\Configurations\CompanyDetailsRequest;

class CompanyDetailsController extends Controller
{
    protected CompanyDetailsInterface $companyDetailsService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(CompanyDetailsInterface $companyDetailsService)
    {
        $this->companyDetailsService = $companyDetailsService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->companyDetailsService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  CompanyDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyDetailsRequest $request)
    {
        return $this->companyDetailsService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  CompanyDetailsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyDetailsRequest $request, $id)
    {
        return $this->companyDetailsService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->companyDetailsService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->companyDetailsService->handleRestoreRecord($id);
    }
}
