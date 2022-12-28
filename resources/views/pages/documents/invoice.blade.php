@extends('layouts.app')

@section('content')

    <div class="document document--invoice">
        <div class="row">
            <div class="col-3 document__supplier">
                @if ($documentData['company'] !== null && count($documentData['company']) !== 0)
                    <p>
                        <span>Furnizor: </span>{{ $documentData['company']['name'] }}
                    </p>
                    <p>
                        <span>Nr. registrul comertului: </span>{{ $documentData['company']['registration_number'] }}
                    </p>
                    <p>
                        <span>C.I.F.: </span>{{ $documentData['company']['fiscal_code'] }}
                    </p>
                    <p>
                        <span>Capital social: </span>{{ $documentData['company']['social_capital'] }}
                    </p>
                    <p>
                        <span>Banca: </span>{{ $documentData['company']['bank_name'] }}
                    </p>
                    <p>
                        <span>Cont bancar: </span>{{ $documentData['company']['bank_account'] }}
                    </p>
                    <p>
                        <span>Sediu: </span>
                        {{ $documentData['company']['country'] }}, {{ $documentData['company']['county'] }},
                        {{ $documentData['company']['city'] }}, {{ $documentData['company']['address'] }}
                    </p>
                    <p>
                        <span>Telefon: </span> {{ $documentData['company']['phone'] }}
                    </p>
                    <p>
                        <span>Email: </span> {{ $documentData['company']['email_address'] }}
                    </p>
                @else
                    <p>
                        <span>Furnizor: </span>
                    </p>
                    <p>
                        <span>Nr. registrul comertului: </span>
                    </p>
                    <p>
                        <span>C.I.F.: </span>
                    </p>
                    <p>
                        <span>Capital social: </span>
                    </p>
                    <p>
                        <span>Banca: </span>
                    </p>
                    <p>
                        <span>Cont bancar: </span>
                    </p>
                    <p>
                        <span>Sediu: </span>
                    </p>
                    <p>
                        <span>Telefon: </span>
                    </p>
                    <p>
                        <span>Email: </span>
                    </p>
                @endif
            </div>

            <div class="col-6 document__header">
                <p>
                    <span>Sales Invoice</span>
                </p>
                @if ($documentData['document_header'] !== null && count($documentData['document_header']) !== 0)
                    <p>
                        <span>Invoice no.: </span>{{ $documentData['document_header']['document_number'] }}
                    </p>
                    <p>
                        <span>Invoice date: </span>{{ $documentData['document_header']['created_at'] }}
                    </p>
                    <p>
                        <span>Order no.:</span>{{ $documentData['document_header']['order_number'] }}
                    </p>
                @else
                    <p>
                        <span>Invoice no.: </span>
                    </p>
                    <p>
                        <span>Invoice date: </span>
                    </p>
                    <p>
                        <span>Order no.:</span>
                    </p>
                @endif
            </div>

            <div class="col-3 document__client">
                @if ($documentData['client'] !== null && count($documentData['client']) !== 0)
                    <p>
                        <span>Client: </span>{{ $documentData['client']['name'] }}
                    </p>
                    <p>
                        <span>Nr. registrul comertului: </span>{{ $documentData['client']['registration_number'] }}
                    </p>
                    <p>
                        <span>C.I.F.: </span>{{ $documentData['client']['fiscal_code'] }}
                    </p>
                    <p>
                        <span>Banca: </span>{{ $documentData['client']['bank_name'] }}
                    </p>
                    <p>
                        <span>Cont bancar: </span>{{ $documentData['client']['bank_account'] }}
                    </p>
                    <p>
                        <span>Address: </span>
                        {{ $documentData['client']['country'] }}, {{ $documentData['client']['county'] }},
                        {{ $documentData['client']['city'] }}, {{ $documentData['client']['address'] }}
                    </p>
                    <p>
                        <span>Telefon: </span>{{ $documentData['client']['phone'] }}
                    </p>
                    <p>
                        <span>Email: </span>{{ $documentData['client']['email_address'] }}
                    </p>
                @else
                    <p>
                        <span>Client: </span>
                    </p>
                    <p>
                        <span>Nr. registrul comertului: </span>
                    </p>
                    <p>
                        <span>C.I.F.: </span>
                    </p>
                    <p>
                        <span>Banca: </span>
                    </p>
                    <p>
                        <span>Cont bancar: </span>
                    </p>
                    <p>
                        <span>Address: </span>
                    </p>
                    <p>
                        <span>Telefon: </span>
                    </p>
                    <p>
                        <span>Email: </span>
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="document__body">
                <p>
                    <span>VAT %: </span>
                </p>
                <p>
                    <span>VAT on cash received</span>
                </p>
                <table class="table">
                    <thead>
                        <tr>
                            @foreach ($documentData['document_settings']['columns'] as $column)
                                @if ($column['id'] < 5)
                                    <th scope="col">
                                        <p>{{ $column['label'] }}</p>
                                    </th>
                                @else
                                    <th scope="col">
                                        <p>{{ $column['label'] }}</p>
                                        <p>&#8212; RON &#8212;</p>
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($documentData['document_settings']['columns'] as $column)
                                @if ($column['id'] < 8)
                                    <th scope="col">
                                        <p>{{ $column['id'] }}</p>
                                    </th>
                                @else
                                    <th scope="col">
                                        <p>{{ $column['id'] }}(4x5x6x7)</p>
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <p>
                                    {{ $documentData['document_settings']['footer']['info_text'] }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                @foreach ($documentData['document_settings']['footer']['delivery_details'] as $footer)
                                    <p>{{ $footer['label'] }}</p>
                                @endforeach
                            </td>
                            <td colspan="3">
                                @foreach ($documentData['document_settings']['footer']['summary'] as $footer)
                                    <p>{{ $footer['label'] }}100.0000 RON</p>
                                @endforeach
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection