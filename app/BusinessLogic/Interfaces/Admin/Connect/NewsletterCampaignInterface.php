<?php

namespace App\BusinessLogic\Interfaces\Admin\Connect;

use App\Http\Requests\Admin\Connect\NewsletterCampaignRequest;

/**
 * NewsletterCampaignInterface is a contract for what methods will be used in the AccountService class.
 * This consists of the following CRUD operations methods:
 * - handleIndex();
 * - handleStore();
 * - handleShow();
 * - handleUpdate();
 * - handleDestroy();
 * - handleRestoreRecord();
 * - handleOrderTableColumn();
 * - handleFilterTableColumn();
 */
interface NewsletterCampaignInterface
{
    /**
     * Fetch all the records from the database.
     * @return \Illuminate\Http\Response
     */
    public function handleIndex();

    /**
     * Store a new record in the database.
     * @param App\Http\Requests\Files\NewsletterCampaignRequest $request
     * @return \Illuminate\Http\Response
     */
    public function handleStore(NewsletterCampaignRequest $request);

    /**
     * Fetch a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id);

    /**
     * Update an existing record in the database.
     * @param App\Http\Requests\Files\NewsletterCampaignRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate(NewsletterCampaignRequest $request, $id);

    /**
     * Delete a single record from the database
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleDestroy($id);

    /**
     * Restore a single record from the database.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function handleRestoreRecord($id);

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
