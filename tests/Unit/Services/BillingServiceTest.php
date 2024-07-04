<?php

use App\Services\V1\BillingService;
use App\Services\V1\EmailService;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

describe('BillingService', function () {

    it('should be called generate correctly', function () {
        $email_service_spy = Mockery::spy(EmailService::class);
        $sut = new BillingService($email_service_spy);
        $fake_file = UploadedFile::fake()->createWithContent(
            'billings.csv',
            <<<CSV
            name,governmentId,email,debtAmount,debtDueDate,debtId
            John Doe,11111111111,johndoe@kanastra.com.br,1000000.00,2022-10-12,1adb6ccf-ff16-467f-bea7-5f05d494280f
            CSV
        );


        $response = $sut->generate($fake_file);

        expect($response->getStatusCode())->toBe(200);
    });

    it('should be returned exeception file error', function(){
        $email_service_mock = Mockery::mock(EmailService::class);
        $sut = new BillingService($email_service_mock);

        expect(function () use ($sut) {
            $sut->generate(NULL);
        })->toThrow(BadRequestException::class, 'File not received!');
    });
});
