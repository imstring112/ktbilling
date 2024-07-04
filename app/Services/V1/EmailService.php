<?php


namespace App\Services\V1;

use App\Jobs\SendEmailJob;
use App\Services\NotificationInterface;
use Illuminate\Support\Facades\Log;

class EmailService implements NotificationInterface
{

    public function send(string $email): void
    {
        Log::info("Initialing send email to: {$email}", [EmailService::class]);

        dispatch(new SendEmailJob($email));
    }
}
