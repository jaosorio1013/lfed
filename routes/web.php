<?php

use App\Http\Controllers\ExportQuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('export-quote/{quote}', ExportQuoteController::class);
