<?php

namespace App\Services;

use App\Contracts\SmsApiInterface;
use Illuminate\Support\Facades\Http;

class SmsApiService implements SmsApiInterface
{
    public function __construct(
        private $apiBaseUrl = null,
        private $apiToken = null
    ) {
        $this->apiBaseUrl = $apiBaseUrl ?? config('sms.api_url');
        $this->apiToken = $apiToken ?? config('sms.api_token');
    }

    public function getNumber(string $country, string $service, ?int $rentTime = null): array
    {
        $params = [
            'action' => 'getNumber',
            'country' => $country,
            'service' => $service,
            'token' => $this->apiToken,
        ];

        if ($rentTime !== null) {
            $params['rent_time'] = $rentTime;
        }

        return $this->makeApiRequest($params);
    }

    public function getSms(string $activationId): array
    {
        $params = [
            'action' => 'getSms',
            'token' => $this->apiToken,
            'activation' => $activationId,
        ];

        return $this->makeApiRequest($params);
    }

    public function cancelNumber(string $activationId): array
    {
        $params = [
            'action' => 'cancelNumber',
            'token' => $this->apiToken,
            'activation' => $activationId,
        ];

        return $this->makeApiRequest($params);
    }

    public function getStatus(string $activationId): array
    {
        $params = [
            'action' => 'getStatus',
            'token' => $this->apiToken,
            'activation' => $activationId,
        ];

        return $this->makeApiRequest($params);
    }

    private function makeApiRequest(array $params): array
    {
        try {
            $response = Http::get($this->apiBaseUrl, $params);
            return $response->json();
        } catch (\Exception $e) {
            return [
                'code' => 'error',
                'message' => 'Error connecting to external API',
            ];
        }
    }
}
