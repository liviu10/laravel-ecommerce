<?php

namespace App\BusinessLogic\Services\Documents;

use App\BusinessLogic\Interfaces\Documents\UserInvoiceInterface;
use App\Models\Admin\Configurations\Company;
use App\Models\Admin\Files\Client;
use App\Models\Admin\Operations\SaleInvoice;
use Illuminate\Database\Eloquent\Collection;

/**
 * UserInvoiceService is a service class the will implement all the methods from the UserInvoiceInterface contract and will handle the business logic.
 */
class UserInvoiceService implements UserInvoiceInterface
{
    protected $companyModelName;
    protected $clientModelName;
    protected $saleInvoiceModelName;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     * @return Collection|String|Integer
     */
    public function __construct()
    {
        $this->companyModelName = new Company();
        $this->clientModelName = new Client();
        $this->saleInvoiceModelName = new SaleInvoice();
    }

    /**
     * Display the user invoice.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleDisplayUserInvoice($request)
    {
        $company = $this->companyModelName->fetchSingleRecord(1);
        $document = $this->saleInvoiceModelName->fetchSingleRecord($request->get('companyId'));

        $documentData = [
            'company'           => $this->handleDisplayCompany($company),
            'document_header'   => $this->handleDocumentHeader($document),
            'client'            => $this->handleDisplayClient($document),
            'document_settings' => $this->handleDocumentSettings(),
        ];

        return view('pages.documents.invoice', compact('documentData'));
    }

    /**
     * Fetch the company details and settings.
     * @param Collection $company
     * @return Array|Null
     */
    public function handleDisplayCompany($company)
    {
        if ($company->isEmpty())
        {
            $data = [];
        }
        else
        {
            $data = [
                'name'                => $company[0]['name'],
                'registration_number' => $company[0]['registration_number'],
                'fiscal_code'         => $company[0]['fiscal_code'],
                'social_capital'      => $company[0]['social_capital'],
                'bank_name'           => $company[0]['company_details'][0]['bank_name'],
                'bank_account'        => $company[0]['company_details'][0]['bank_account'],
                'country'             => $company[0]['company_details'][0]['country']->name,
                'county'              => $company[0]['company_details'][0]['county']->name,
                'city'                => $company[0]['company_details'][0]['city']->name,
                'address'             => $company[0]['company_details'][0]['address'],
                'phone'               => $company[0]['company_details'][0]['phone'],
                'email_address'       => $company[0]['company_details'][0]['email_address']
            ];

            return $data;
        }
    }

    /**
     * Fetch the document header (invoice number, date and order number).
     * @param Collection $document
     * @return Array|Null
     */
    public function handleDocumentHeader($document)
    {
        if ($document->isEmpty())
        {
            $data = [];
        }
        else
        {
            $data = [
                'document_number' => $document[0]['document_number'],
                'created_at'      => $document[0]['created_at'],
                'order_number'    => ''
            ];
            return $data;
        }
    }

    /**
     * Fetch the client details and settings.
     * @param Collection $document
     * @return Array|Null
     */
    public function handleDisplayClient($document)
    {
        if ($document->isEmpty())
        {
            $data = [];
        }
        else
        {
            $getClient = $this->clientModelName->fetchSingleRecord($document[0]['client_id']);
            $data = [
                'name'                => $getClient[0]['name'],
                'registration_number' => $getClient[0]['registration_number'],
                'fiscal_code'         => $getClient[0]['fiscal_code'],
                'social_capital'      => $getClient[0]['social_capital'],
                'bank_name'           => $getClient[0]['bank_name'],
                'bank_account'        => $getClient[0]['bank_account'],
                'country'             => $getClient[0]['country']->name,
                'county'              => $getClient[0]['county']->name,
                'city'                => $getClient[0]['city']->name,
                'address'             => $getClient[0]['address'],
                'phone'               => $getClient[0]['phone'],
                'email_address'       => $getClient[0]['email_address']
            ];
            return $data;
        }
    }

    /**
     * Display the document's settings.
     * @return Array
     */
    public function handleDocumentSettings()
    {
        $documentSettings = [
            'columns' => [
                0 => [
                    'id'    => 0,
                    'label' => 'ID',
                ],
                1 => [
                    'id'    => 1,
                    'label' => 'Code',
                ],
                2 => [
                    'id'    => 2,
                    'label' => 'Product name or service',
                ],
                3 => [
                    'id'    => 3,
                    'label' => 'U.M.',
                ],
                4 => [
                    'id'    => 4,
                    'label' => 'Quantity',
                ],
                5 => [
                    'id'    => 5,
                    'label' => 'Unit price',
                ],
                6 => [
                    'id'    => 6,
                    'label' => 'Discount amount',
                ],
                7 => [
                    'id'    => 7,
                    'label' => 'VAT amount',
                ],
                8 => [
                    'id'    => 8,
                    'label' => 'Net price',
                ],
            ],
            'footer' => [
                'info_text' => 'Document valabil fara semnatura si stampila furnizorului conform codului fiscal, art. 319, alin. 29. Poate fi acceptat si in format electronic.',
                'delivery_details' => [
                    0 => [
                        'id'    => 0,
                        'label' => 'Detalii expeditie'
                    ],
                    1 => [
                        'id'    => 1,
                        'label' => 'Intocmit de: '
                    ],
                    2 => [
                        'id'    => 2,
                        'label' => 'CNP: '
                    ],
                    3 => [
                        'id'    => 3,
                        'label' => 'Numele delegatului: '
                    ],
                    4 => [
                        'id'    => 4,
                        'label' => 'B.I./C.I.: '
                    ],
                    5 => [
                        'id'    => 5,
                        'label' => 'Mijloc de transport: '
                    ],
                    6 => [
                        'id'    => 6,
                        'label' => 'Expedierea s-a efectuat in prezenta noastra la data de ... ora ...'
                    ]
                ],
                'summary' => [
                    0 => [
                        'id'    => 0,
                        'label' => 'Total fara TVA: '
                    ],
                    1 => [
                        'id'    => 1,
                        'label' => 'Total cu TVA: '
                    ],
                    2 => [
                        'id'    => 2,
                        'label' => 'Semnatura de primire: '
                    ]
                ]
            ]
        ];

        return $documentSettings;
    }
}