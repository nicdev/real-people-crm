<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Contact $contact;

    public $showContactEventModal = false;

    public $showContactForm = false;

    public $title = 'Contact';

    public function render()
    {
        return view('livewire.contacts.show');
    }

    public function mount(Contact $contact)
    {
        $this->authorize('view', $contact);
        $this->contact = $contact;
        $this->title = $contact->first_name.' '.$contact->last_name;
    }

    public function delete(Contact $contact)
    {
        $this->authorize('delete', $contact);
        
        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showContactEventModal = false;
        $this->showContactForm = false;
    }
}
