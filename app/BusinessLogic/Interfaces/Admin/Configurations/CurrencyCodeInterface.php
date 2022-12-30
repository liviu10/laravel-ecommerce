<?php

namespace App\BusinessLogic\Interfaces\Admin\Configurations;

use App\Http\Requests\Admin\Configurations\CurrencyCodeRequest;

/**
 * CurrencyCodeInterface is a contract for what methods will be used in the CountryService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleShow();
 * - handleUpdate();
 * - handleDestroy();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface CurrencyCodeInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Configurations\CurrencyCodeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CurrencyCodeRequest $request);

    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Configurations\CurrencyCodeRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CurrencyCodeRequest $request, $id);

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
