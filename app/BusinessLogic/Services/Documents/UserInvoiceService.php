<?php

namespace App\BusinessLogic\Services\Documents;

use App\BusinessLogic\Interfaces\Documents\UserInvoiceInterface;
use App\Models\Admin\Operations\Invoice;
use Illuminate\Database\Eloquent\Collection;

/**
 * UserInvoiceService is a service class the will implement all the methods from the UserInvoiceInterface contract and will handle the business logic.
 */
class UserInvoiceService implements UserInvoiceInterface
{
    protected $modelName;
    protected $tableName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->modelName = new Invoice();
        $this->tableName = $this->modelName->getTable();
    }

    /**
     * Fetch a single record from the database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function handleShow($id)
    {
        $displaySingleRecord = $this->modelName->fetchSingleRecord($id);

        if ($displaySingleRecord instanceof Collection)
        {
            if ($displaySingleRecord->isEmpty())
            {
                abort(404);
            }
            else
            {
                return view('pages.documents.invoice', compact('displaySingleRecord'));
            }
        }
        else
        {
            abort(500);
        }
    }
}