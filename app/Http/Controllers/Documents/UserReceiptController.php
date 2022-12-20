<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessLogic\Interfaces\Documents\UserReceiptInterface;

class UserReceiptController extends Controller
{
    protected UserReceiptInterface $userReceiptService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(UserReceiptInterface $userReceiptService)
    {
        $this->userReceiptService = $userReceiptService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->userReceiptService->handleShow($id);
    }
}
