<?php

namespace App\Services\V1;

use App\Services\ServiceInterface;
use Illuminate\Http\UploadedFile;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BillingService implements ServiceInterface
{
    public function  __construct(private readonly EmailService $email_service)
    {
    }

    public function generate(UploadedFile | null $file)
    {

        if (!$file) throw new BadRequestException('File not received!');

        $fileStoragePath = $file->store('billings');

        $csv = Reader::createFromPath(storage_path('app/' . $fileStoragePath), 'r');
        $batchSize = 100;
        $csv->setHeaderOffset(0);

        $chunk = [];
        foreach ($csv as $index => $row) {
            $chunk[] = $row['email'];

            if (count($chunk) == $batchSize || $index + 1 === count($csv)) {
                $this->email_service->send($chunk);
                $chunk = [];
            }
        }

        return response()->json(['Billings sends with success'], 200);
    }
}
