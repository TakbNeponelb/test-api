<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsProxyController;

Route::get('/getNumber', [SmsProxyController::class, 'getNumber']);
Route::get('/getSms', [SmsProxyController::class, 'getSms']);
Route::get('/cancelNumber', [SmsProxyController::class, 'cancelNumber']);
Route::get('/getStatus', [SmsProxyController::class, 'getStatus']);
