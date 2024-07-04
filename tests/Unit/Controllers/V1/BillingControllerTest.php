<?php

use App\Http\Controllers\API\V1\BillingController;
use App\Http\Requests\BillingRequest;
use App\Services\V1\BillingService;
use Illuminate\Http\UploadedFile;

describe('BillingController', function () {

    it('shoul be called correctly', function () {
        $fake_file = UploadedFile::fake()->create('test.csv');
        $request_mock = Mockery::mock(BillingRequest::class);
        $request_mock->shouldReceive('file')->andReturn($fake_file);
        $billing_service_mock = Mockery::mock(BillingService::class);
        $billing_service_mock->shouldReceive('generate')->with($fake_file)->andReturn(true);

        $sut = new BillingController($billing_service_mock);

        expect($sut->process($request_mock))->toBeTruthy();
    });
});
