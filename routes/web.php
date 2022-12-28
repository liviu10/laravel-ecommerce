<?php

use Illuminate\Support\Facades\Route;   

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    use App\Http\Controllers\Documents\UserInvoiceController;
    use App\Http\Controllers\Documents\UserReceiptController;
    use App\Http\Controllers\Documents\UserShippingNoteController;
    use App\Http\Controllers\Documents\UserWarrantyController;

    Route::group([ 'prefix' => '/documents' ], function () {
        Route::get('/invoice', [UserInvoiceController::class, 'displayUserInvoice']);
        Route::resource('/receipt', UserReceiptController::class)->only('show');
        Route::resource('/shipping-note', UserShippingNoteController::class)->only('show');
        Route::resource('/warranty', UserWarrantyController::class)->only('show');
    });
