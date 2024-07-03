<?php

use App\Http\Controllers\API\V1\BillingController;
use Illuminate\Support\Facades\Route;

Route::namespace('API/V1')
    ->prefix('v1')
    ->group(function () {
        Route::post('billing', [BillingController::class, 'process']);
    });
