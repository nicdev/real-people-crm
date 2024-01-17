<?php

namespace App\Livewire\ContactEvents;

use App\Models\Contact;
use Livewire\Component;

class NextFollowUp extends Component
{
    public $contact;

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function enableFollowUp() {
        $this->contact->update([
            'no_follow_up' => false,
            'follow_up_date' => now()->addDays($this->contact->frequency),
        ]);
    }

    public function updateFollowUp($newDate) {
        $this->contact->update([
            'follow_up_date' => $newDate,
        ]);
    }
}