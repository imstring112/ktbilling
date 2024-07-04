<?php

namespace App\Services;

interface NotificationInterface {
    public function send(string $email): void;
}
