<?php

use App\Jobs\SendEmailJob;
use App\Services\V1\EmailService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

describe('EmailService', function () {

    it('should dispatches correctly for each email', function () {
        Queue::fake();

        $emails = ['user1@example.com', 'user2@example.com', 'user3@example.com'];
        $sut = new EmailService();

        $sut->send($emails);

        foreach ($emails as $email) {
            Queue::assertPushed(SendEmailJob::class, function ($job) use ($email) {
                return $job->email === $email;
            });
        }
    });

    it('should be shoot logs emails', function () {
        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return $message === 'Initialing send email to: user1@example.com' && in_array(EmailService::class, $context);
            });

        Queue::fake();
        $emails = ['user1@example.com'];
        $sut = new EmailService();

        $sut->send($emails);
    });
});
