<?php

use Illuminate\Support\Facades\Route;
Auth::routes([
    'verify' => true,
    'reset' => false,
    'confirm' => false,
    'register' => false,
    'password.request' => false,
    'password.email' => false,
    'password.reset' => false,
    'password.confirm' => false,
    'email.verify' => false,
    'email.resend' => false,
]);

Route::get('/' , App\Http\Controllers\Welcome::class)->name('/');
Route::group(['middleware' => ['throttle:100,1','lock']],function(){

    
    Route::group(['middleware' => ['auth','verified']],function(){

        Route::get('invoices/{invoice}' , App\Http\Controllers\Invoice::class)->name('invoice');

        Route::group(['middleware' => ['permission']],function(){
            Route::get('home' , App\Http\Controllers\Home::class)->name('home');
            Route::get('sell' , App\Http\Controllers\Sell::class)->name('sell');
            Route::get('colors' , App\Http\Controllers\Colors::class)->name('colors');
            Route::get('companies' , App\Http\Controllers\Companies::class)->name('companies');
            Route::get('suppliers' , App\Http\Controllers\Suppliers::class)->name('suppliers');
            Route::get('settings' , App\Http\Controllers\Settings::class)->name('settings');
            Route::get('users' , App\Http\Controllers\Users::class)->name('users');
            Route::get('invoices' , App\Http\Controllers\Invoices::class)->name('invoices');
            Route::get('devices' , App\Http\Controllers\Devices::class)->name('devices');
            Route::get('countries' , App\Http\Controllers\Countries::class)->name('countries');
            Route::get('sales' , App\Http\Controllers\Sales::class)->name('sales');
            Route::get('refunds' , App\Http\Controllers\Refunds::class)->name('refunds');
        });
    });
});

