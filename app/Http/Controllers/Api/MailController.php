<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\DailyEvents;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonthlyEvents;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * This method is in charge of sending the daily events mail.
     * 
     * @return void
     */
    public function dailyEvents()
    {
        Mail::to(config('mail.to'))->send(new DailyEvents());
    }

    /**
     * This method is in charge of sending the monthly events mail.
     * 
     * @return void
     */
    public function monthlyEvents()
    {
        Mail::to(config('mail.to'))->send(new MonthlyEvents());
    }
}
