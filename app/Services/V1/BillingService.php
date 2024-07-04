<?php

namespace App\Services\V1;

use App\Services\ServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use League\Csv\Statement;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BillingService implements ServiceInterface
{
    public function  __construct(private readonly EmailService $email_service)
    {
    }

    public function generate(UploadedFile $file)
    {

        if (!$file) throw new HttpException('File not received!', 400);

        $fileStoragePath = $file->store('billings');

        $reader = Reader::createFromPath(storage_path('app/' . $fileStoragePath), 'r');
        $reader->setHeaderOffset(0);

        $chunkSize = 1000;
        $offset = 0;
        do {
            $statement = Statement::create();
            $statement->offset($offset)->limit($chunkSize);
            $records = $statement->process($reader);

            $emails = [];
            foreach ($records as $record) {
                if (isset($record['email'])) {
                    $emails[] = $record['email'];
                }
            }

            foreach ($emails as $email) {
                $this->email_service->send($email);
            }

            $offset += $chunkSize;
        } while (count($records) > 0);

        return response()->json(['Billings sends with success'], 200);
    }
}
