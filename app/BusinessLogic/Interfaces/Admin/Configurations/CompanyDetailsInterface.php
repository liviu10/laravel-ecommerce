<?php

namespace App\BusinessLogic\Interfaces\Admin\Configurations;

use App\Http\Requests\Admin\Configurations\CompanyDetailsRequest;

/**
 * CompanyDetailsInterface is a contract for what methods will be used in the CompanyDetailsService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleUpdate();
 * - handleDestroy();
 * - handleRestoreRecord();
 */
interface CompanyDetailsInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Configurations\CompanyDetailsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CompanyDetailsRequest $request);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Configurations\CompanyDetailsRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CompanyDetailsRequest $request, $id);

    /**
     * Delete a single record from the database
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleDestroy($id);

    /**
     * Restore a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleRestoreRecord($id);
}
