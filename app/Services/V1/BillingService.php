<?php

namespace App\Services\V1;

use App\Services\ServiceInterface;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BillingService implements ServiceInterface {
    public function  __construct(private readonly EmailService $email_service){}

    public function generate(UploadedFile $file) {

        if (!$file) throw new HttpException('File not received!', 400);

        $file_storage_path = $file->store('billings');
        $file_instance = fopen(storage_path('app/' . $file_storage_path), 'r');
        $header = fgetcsv($file_instance);

        $email_index = array_search('email', $header);

        if (!$email_index) throw new HttpException('Email column not found!', 400);

        while($row = fgetcsv($file_instance)) {
            $email = $row[$email_index];
            $this->email_service->send($email);
        }
    }
}
