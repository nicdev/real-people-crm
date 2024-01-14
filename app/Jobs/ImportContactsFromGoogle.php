<?php

namespace App\Jobs;

use App\Actions\Contacts\ImportContacts;
use App\Models\User;
use App\Notifications\FinishedImportContactsFromGoogle;
use App\Services\GooglePeopleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportContactsFromGoogle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $userId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(GooglePeopleService $googlePeople, ImportContacts $importContacts): void
    {
        $user = User::find($this->userId);

        // check for expired token
        if (! $user->token_expires_at || $user->token_expires_at->isPast()) {
            $response = $googlePeople->refreshToken($user->google_refresh_token);
            $user->update([
                'google_token' => $response['access_token'],
                'token_expires_at' => now()->addSeconds($response['expires_in']),
            ]);
        }

        $googlePeople->setToken($user->google_token);
        $importContacts($googlePeople->contacts(), $user);

        $user->notify(new FinishedImportContactsFromGoogle());
    }
}
