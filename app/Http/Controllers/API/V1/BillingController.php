<?php

namespace App\Http\Controllers;

use App\Services\Service;

class BillingController extends Controller
{
    public function __construct(private readonly Service $billing_service){}
    public function process($request) : void {
        return $this->billing_service->createBillings();
    }
}
