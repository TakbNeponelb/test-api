<?php

namespace App\Contracts;

interface SmsApiInterface
{
    public function getNumber(string $country, string $service, ?int $rentTime = null): array;
    public function getSms(string $activationId): array;
    public function cancelNumber(string $activationId): array;
    public function getStatus(string $activationId): array;
}
