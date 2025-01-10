<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\SmsApiInterface;
use App\Services\SmsApiService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SmsApiInterface::class, function ($app) {
            return new SmsApiService(
                config('sms.api_url'),
                config('sms.api_token')
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
