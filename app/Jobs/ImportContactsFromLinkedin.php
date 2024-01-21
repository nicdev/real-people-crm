<?php

namespace App\Jobs;

use App\Actions\Contacts\ImportContacts;
use App\Models\User;
use App\Notifications\FinishedImportContactsFromGoogle;
use App\Services\LinkedinPeopleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportContactsFromLinkedin implements ShouldQueue
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
    public function handle(LinkedinPeopleService $linkedinPeople, ImportContacts $importContacts): void
    {
        // Not implemented because LI API sucks donkey balls
    }
}
