<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\CurrencyCodeInterface;
use App\Http\Requests\Admin\Configurations\CurrencyCodeRequest;

class CurrencyCodeController extends Controller
{
    protected CurrencyCodeInterface $currencyCodeService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(CurrencyCodeInterface $currencyCodeService)
    {
        $this->currencyCodeService = $currencyCodeService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->currencyCodeService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  CurrencyCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyCodeRequest $request)
    {
        return $this->currencyCodeService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->currencyCodeService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  CurrencyCodeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyCodeRequest $request, $id)
    {
        return $this->currencyCodeService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->currencyCodeService->handleDestroy($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->currencyCodeService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->currencyCodeService->handleFilterTableColumn($request);
    }
}
