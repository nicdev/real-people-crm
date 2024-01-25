<?php

namespace App\Livewire\ContactEvents;

use App\Models\Contact;
use Livewire\Component;

class Index extends Component
{
    public Contact $contact;

    public function render()
    {
        $contactEvents = $this->contact->contactEvents()->orderBy('date', 'desc')->orderBy('updated_at', 'desc')->paginate(5);

        return view('livewire.contact-events.index')->with(compact('contactEvents'));
    }

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function delete(Contact $contact)
    {
        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }
}
