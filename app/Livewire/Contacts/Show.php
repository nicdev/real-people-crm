<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;

class Show extends Component
{
    public Contact $contact;

    public function render()
    {
        return view('livewire.contacts.show')->with([
            'contact' => $this->contact,
        ]);
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
