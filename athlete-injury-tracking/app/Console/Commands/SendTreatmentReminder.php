<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Athlete;
use App\Models\Treatment;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendTreatmentReminder extends Command
{
    // The name and signature of the console command.
    protected $signature = 'athletes:send-treatment-reminder';

    // The console command description.
    protected $description = 'Send reminders to athletes about their upcoming treatments';

    // Execute the console command.
    public function handle()
    {
        $currentDate = Carbon::now();
        $reminderDate = $currentDate->addDays(2);  // Send reminder 2 days before the treatment

        // Find athletes with upcoming treatments
        $athletes = Athlete::whereHas('treatments', function ($query) use ($reminderDate) {
            $query->whereDate('treatment_date', '=', $reminderDate->toDateString());
        })->get();

        // Loop through each athlete and send reminder
        foreach ($athletes as $athlete) {
            $treatment = $athlete->treatments->firstWhere('treatment_date', $reminderDate->toDateString());

            // Send reminder email (you can create a real email template later)
            Mail::to($athlete->email)->send(new \App\Mail\TreatmentReminder($athlete, $treatment));

            // Inform the user via command output
            $this->info("Sent reminder to athlete: {$athlete->name} for treatment on {$treatment->treatment_date}");
        }

        $this->info('All reminders have been sent.');
    }
}
