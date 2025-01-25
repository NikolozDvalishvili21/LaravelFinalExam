<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Athlete;
use App\Models\Treatment;

class TreatmentReminder extends Mailable
{
    public $athlete;
    public $treatment;

    public function __construct(Athlete $athlete, Treatment $treatment)
    {
        $this->athlete = $athlete;
        $this->treatment = $treatment;
    }

    public function build()
    {
        return $this->subject('Reminder: Upcoming Treatment')
                    ->view('emails.treatment_reminder');  
    }
}
