<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Operations\ShippingNoteLineInterface;
use App\Http\Requests\Admin\Operations\ShippingNoteLineRequest;

class ShippingNoteLineController extends Controller
{
    protected ShippingNoteLineInterface $shippingNoteLineService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(ShippingNoteLineInterface $shippingNoteLineService)
    {
        $this->shippingNoteLineService = $shippingNoteLineService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->shippingNoteLineService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  ShippingNoteLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingNoteLineRequest $request)
    {
        return $this->shippingNoteLineService->handleStore($request);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  ShippingNoteLineRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingNoteLineRequest $request, $id)
    {
        return $this->shippingNoteLineService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->shippingNoteLineService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->shippingNoteLineService->handleRestoreRecord($id);
    }
}
