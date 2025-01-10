<?php

namespace App\Http\Controllers;

use App\Contracts\SmsApiInterface;
use Illuminate\Http\Request;

class SmsProxyController extends Controller
{


    public function __construct(
        private SmsApiInterface $smsApiService
    ) {}

    public function getNumber(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required',
            'service' => 'required',
            'rent_time' => 'nullable|integer',
        ]);

        $response = $this->smsApiService->getNumber(
            $validated['country'],
            $validated['service'],
            $validated['rent_time'] ?? null
        );

        return response()->json($response);
    }

    public function getSms(Request $request)
    {
        $validated = $request->validate([
            'activation' => 'required',
        ]);

        $response = $this->smsApiService->getSms($validated['activation']);
        return response()->json($response);
    }

    public function cancelNumber(Request $request)
    {
        $validated = $request->validate([
            'activation' => 'required',
        ]);

        $response = $this->smsApiService->cancelNumber($validated['activation']);
        return response()->json($response);
    }

    public function getStatus(Request $request)
    {
        $validated = $request->validate([
            'activation' => 'required',
        ]);

        $response = $this->smsApiService->getStatus($validated['activation']);
        return response()->json($response);
    }
}
