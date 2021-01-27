<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Mail routes.
|--------------------------------------------------------------------------
*/

Route::post('/mail/daily-events', 'App\Http\Controllers\Api\MailController@dailyEvents')->name('mail.daily-events')->middleware('auth.basic');

Route::post('/mail/monthly-events', 'App\Http\Controllers\Api\MailController@monthlyEvents')->name('mail.monthly-events')->middleware('auth.basic');