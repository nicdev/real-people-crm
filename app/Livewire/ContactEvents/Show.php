<?php

namespace App\Livewire\ContactEvents;

use App\Models\ContactEvent;
use Livewire\Component;

class Show extends Component
{
    public ContactEvent $contactEvent;

    public function render()
    {
        return view('livewire.contact-events.show')->with([
            'contact' => $this->contactEvent,
        ]);
    }

    public function mount(ContactEvent $contactEvent)
    {
        $this->contactEvent = $contactEvent;
    }

    public function delete(ContactEvent $contactEvent)
    {
        $contactEvent->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }
}
