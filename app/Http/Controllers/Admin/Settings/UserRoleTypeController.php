<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Settings\UserRoleTypeInterface;

class UserRoleTypeController extends Controller
{
    protected UserRoleTypeInterface $userRoleTypeService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(UserRoleTypeInterface $userRoleTypeService)
    {
        $this->userRoleTypeService = $userRoleTypeService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userRoleTypeService->handleIndex();
    }
}
