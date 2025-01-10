<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsProxyController extends Controller
{

    public function __construct(
        private $apiBaseUrl = null,
        private $apiToken = null
    ) {
        $this->apiBaseUrl = $apiBaseUrl ?? config('sms.api_url');
        $this->apiToken = $apiToken ?? config('sms.api_token');
    }

    public function getNumber(Request $request)
    {
        $params = $request->validate([
            'country' => 'required',
            'service' => 'required',
            'rent_time' => 'nullable|integer',
        ]);

        $params['action'] = 'getNumber';
        $params['token'] = $this->apiToken;

        return $this->makeApiRequest($params);
    }

    public function getSms(Request $request)
    {
        $params = $request->validate([
            'activation' => 'required',
        ]);

        $params['action'] = 'getSms';
        $params['token'] = $this->apiToken;

        return $this->makeApiRequest($params);
    }

    public function cancelNumber(Request $request)
    {
        $params = $request->validate([
            'activation' => 'required',
        ]);

        $params['action'] = 'cancelNumber';
        $params['token'] = $this->apiToken;

        return $this->makeApiRequest($params);
    }

    public function getStatus(Request $request)
    {
        $params = $request->validate([
            'activation' => 'required',
        ]);

        $params['action'] = 'getStatus';
        $params['token'] = $this->apiToken;

        return $this->makeApiRequest($params);
    }

    private function makeApiRequest($params)
    {
        try {
            $response = Http::get($this->apiBaseUrl, $params);

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'error',
                'message' => 'Error connecting to external API'
            ], 500);
        }
    }
}
