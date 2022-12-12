<?php

namespace App\BusinessLogic\Interfaces\Admin\Configurations;

use App\Http\Requests\Admin\Configurations\CountryRequest;

/**
 * CountryInterface is a contract for what methods will be used in the CountryService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleShow();
 * - handleUpdate();
 * - handleDestroy();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface CountryInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Configurations\CountryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CountryRequest $request);

    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Configurations\CountryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CountryRequest $request, $id);

    /**
     * Delete a single record from the database
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleDestroy($id);

    /**
     * Order all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleOrderTableColumn($request);

    /**
     * Filter all the records from the database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleFilterTableColumn($request);
}
