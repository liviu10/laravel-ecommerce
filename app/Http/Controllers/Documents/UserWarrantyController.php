<?php

namespace App\Http\Controllers\Documents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessLogic\Interfaces\Documents\UserWarrantyInterface;

class UserWarrantyController extends Controller
{
    protected UserWarrantyInterface $userWarrantyService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(UserWarrantyInterface $userWarrantyService)
    {
        $this->userWarrantyService = $userWarrantyService;
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
        return $this->userWarrantyService->handleShow($id);
    }
}
