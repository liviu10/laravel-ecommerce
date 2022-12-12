<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\CashAndBankRegisterInterface;
use App\Http\Requests\Admin\Operations\CashAndBankRegisterRequest;

class CashAndBankRegisterController extends Controller
{
    protected CashAndBankRegisterInterface $cashAndBankRegisterService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(CashAndBankRegisterInterface $cashAndBankRegisterService)
    {
        $this->cashAndBankRegisterService = $cashAndBankRegisterService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->cashAndBankRegisterService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  CashAndBankRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashAndBankRegisterRequest $request)
    {
        return $this->cashAndBankRegisterService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  CashAndBankRegisterRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CashAndBankRegisterRequest $request, $id)
    {
        return $this->cashAndBankRegisterService->handleUpdate($request, $id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->cashAndBankRegisterService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->cashAndBankRegisterService->handleFilterTableColumn($request);
    }
}
