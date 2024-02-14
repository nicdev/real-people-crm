<?php

namespace App\Console\Commands;

use App\Mail\DailyReminder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders with contacts that should be reached out to today.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ray('Sending daily reminders');
        User::whereHas('contacts', function ($query) {
            $query->where('follow_up_date', now()->format('Y-m-d'));
        })->get()->each(function ($user) {
            $contacts = $user->contacts()->where('follow_up_date', now()->format('Y-m-d'))->get();
            Mail::to($user)->send(new DailyReminder($contacts));
        });
    }
}
