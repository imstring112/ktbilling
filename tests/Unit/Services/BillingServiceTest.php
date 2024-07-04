<?php

use App\Services\V1\BillingService;
use App\Services\V1\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

describe('BillingService', function() {
    $fake_file = UploadedFile::fake()->create('test.csv');
    $email_service_mock = Mockery::mock(EmailService::class);
    $email_service_mock->shouldReceive('send')->andReturn();
    $sut = new BillingService($email_service_mock);

    $response = $sut->generate($fake_file);

    expect($response)->toBeInstanceOf(JsonResponse::class);
});
