<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class Dashboard extends Component
{
    public $followUpDate;

    public $search;

    public function render()
    {
        $followUpList = auth()->user()->contacts()
            ->where('no_follow_up', false)
            ->where('follow_up_date', '<=', now()->addDays(7)) // Overdue or within the next 7 days
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->orWhere('first_name', 'like', "%{$this->search}%")
                        ->orWhere('middle_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('general_notes', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('follow_up_date', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate(10);

        $followUpList->withPath('/dashboard');

        return view('livewire.dashboard')->with(compact('followUpList'));
    }

    public function snooze($contactId, $days)
    {
        $this->authorize('update', Contact::find($contactId));
        
        $contact = Contact::find($contactId);

        $contact->update([
            'follow_up_date' => $contact->follow_up_date->addDays($days),
        ]);
    }

    public function updateFollowUp($newDate, $contactId)
    {
        $this->authorize('update', Contact::find($contactId));
        
        $contact = Contact::find($contactId);
        $contact->update([
            'follow_up_date' => $newDate,
        ]);
    }

    public function cancelFollowUp($contactId)
    {
        $this->authorize('update', Contact::find($contactId));
        
        $contact = Contact::find($contactId);
        $contact->update([
            'no_follow_up' => true,
        ]);
    }
}
