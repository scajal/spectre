<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonthlyEvents extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The birthday people.
     * 
     * @var array
     */
    public $birthdays;

    /**
     * The anniversary people.
     * 
     * @var array
     */
    public $anniversaries;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->birthdays = config('models.person')::isMonthBirthday()->get();
        $this->anniversaries = config('models.person')::isMonthAnniversary()->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.monthly-events');
    }
}
