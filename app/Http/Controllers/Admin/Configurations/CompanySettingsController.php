<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\CompanySettingsInterface;
use App\Http\Requests\Admin\Configurations\CompanySettingsRequest;

class CompanySettingsController extends Controller
{
    protected CompanySettingsInterface $companySettingsService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(CompanySettingsInterface $companySettingsService)
    {
        $this->companySettingsService = $companySettingsService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->companySettingsService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  CompanySettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanySettingsRequest $request)
    {
        return $this->companySettingsService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  CompanySettingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanySettingsRequest $request, $id)
    {
        return $this->companySettingsService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->companySettingsService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->companySettingsService->handleRestoreRecord($id);
    }
}
