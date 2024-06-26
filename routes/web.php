<?php

use App\Http\Controllers\ExportQuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('export-quote', ExportQuoteController::class)->name('export-quote');

// Route::middleware('signed')
//     ->get('invitation/{invitation}/accept', AcceptInvitation::class)
//     ->name('invitation.accept');

// Route::middleware('signed')
//     ->get('quotes/{quote}/pdf', QuotePdfController::class)
//     ->name('quotes.pdf');
