<?php

namespace App\Livewire\Contacts;

use App\Actions\Contacts\AugmentWithLinkedIn;
use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
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
        $this->title = $contact->first_name . ' ' . $contact->last_name;
    }

    // Having an issue where a 404 is triggered on deletion
    // before I can redirect.
    // #[Renderless]
    public function delete()
    {
        // $this->skipHydrate();
        
        $this->authorize('delete', $this->contact);

        $this->contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showContactEventModal = false;
        $this->showContactForm = false;
    }

    public function augmentWithLinkedIn(AugmentWithLinkedIn $augmentWithLinkedIn)
    {
        $augmentWithLinkedIn($this->contact);
    }
}
