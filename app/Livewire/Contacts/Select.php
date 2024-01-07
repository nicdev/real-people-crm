<?php

namespace App\Livewire\Contacts;

use Illuminate\Support\Collection;
use Livewire\Component;

class Select extends Component
{
    public Collection $contacts;

    public function render()
    {
        return view('livewire.contacts.select')->with(['contacts' => $this->contacts]);
    }

    public function updatedContactId($contact_id)
    {
        ray('doing change', $contact_id);
        $this->dispatch('updated-contact-id', $contact_id);
    }

    public function mount(Collection $contacts)
    {
        $this->contacts = $contacts;
    }
}
