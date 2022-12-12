<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Configurations\AccountTypeInterface;

class AccountTypeController extends Controller
{
    protected AccountTypeInterface $accountTypeService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(AccountTypeInterface $accountTypeService)
    {
        $this->accountTypeService = $accountTypeService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->accountTypeService->handleIndex();
    }
}
