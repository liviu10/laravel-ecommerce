<?php

namespace App\BusinessLogic\Interfaces\Admin\Operations;

use App\Http\Requests\Admin\Operations\CashAndBankRegisterRequest;

/**
 * CashAndBankRegisterInterface is a contract for what methods will be used in the CountryService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleUpdate();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface CashAndBankRegisterInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Operations\CashAndBankRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(CashAndBankRegisterRequest $request);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Operations\CashAndBankRegisterRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(CashAndBankRegisterRequest $request, $id);

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
