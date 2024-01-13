<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $showContactForm = false;

    public $showContactEventForm = false;

    public function render()
    {
        $contacts = auth()->user()->contacts;

        return view('livewire.contacts.index')->with(compact('contacts'));
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showContactForm = false;
        $this->showContactEventForm = false;
    }

    public function delete(Contact $contact)
    {
        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }
}
