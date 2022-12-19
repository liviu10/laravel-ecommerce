<?php

namespace App\Http\Controllers\Admin\Connect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogic\Interfaces\Admin\Connect\NewsletterSubscriberInterface;
use App\Http\Requests\Admin\Connect\NewsletterSubscriberRequest;

class NewsletterSubscriberController extends Controller
{
    protected NewsletterSubscriberInterface $newsletterSubscriberService;

    /**
     * Instantiate the interface that will be used to get all the methods that are going to be used in this controller.
     */
    public function __construct(NewsletterSubscriberInterface $newsletterSubscriberService)
    {
        $this->newsletterSubscriberService = $newsletterSubscriberService;
    }

    /**
     * Fetch all the records from the database. HTTP request [GET].
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->newsletterSubscriberService->handleIndex();
    }

    /**
     * Store a new record in the database. HTTP request [POST].
     * @param  NewsletterSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsletterSubscriberRequest $request)
    {
        return $this->newsletterSubscriberService->handleStore($request);
    }

    /**
     * Display the specified resource. HTTP request [GET].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->newsletterSubscriberService->handleShow($id);
    }

    /**
     * Update an existing record in the database. HTTP request [PUT].
     * @param  NewsletterSubscriberRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsletterSubscriberRequest $request, $id)
    {
        return $this->newsletterSubscriberService->handleUpdate($request, $id);
    }

    /**
     * Delete a single record from the database. HTTP request [DELETE].
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->newsletterSubscriberService->handleDestroy($id);
    }

    /**
     * Restore a single record from the database. HTTP request [GET]
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreRecord($id)
    {
        return $this->newsletterSubscriberService->handleRestoreRecord($id);
    }

    /**
     * Order all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderTableColumn(Request $request)
    {
        return $this->newsletterSubscriberService->handleOrderTableColumn($request);
    }

    /**
     * Filter all the records from the database. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filterTableColumn(Request $request)
    {
        return $this->newsletterSubscriberService->handleFilterTableColumn($request);
    }

    /**
     * Unsubscribe the user from the newsletter. HTTP request [DELETE]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unsubscribeUser(Request $request)
    {
        return $this->newsletterSubscriberService->handleUnsubscribeUser($request);
    }

    /**
     * Restore the user subscription. HTTP request [GET]
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restoreSubscription(Request $request)
    {
        return $this->newsletterSubscriberService->handleRestoreSubscription($request);
    }
}
