<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillingRequest;
use App\Services\V1\BillingService;

class BillingController extends Controller
{
    public function __construct(private readonly BillingService $billing_service){}
    public function process(BillingRequest $request) {
        return $this->billing_service->generate($request->file('file'));
    }
}
