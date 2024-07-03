<?php

use App\Http\Controllers\BillingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('API/V1')->post('billing', [BillingController::class, 'proccess']);
