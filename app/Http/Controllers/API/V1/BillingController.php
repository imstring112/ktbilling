<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\BillingService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function __construct(private readonly BillingService $billing_service){}
    public function process(Request $request) : void {
        dd('teste');
        // return $this->billing_service->createBillings();
    }
}
