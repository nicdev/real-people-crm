<?php

namespace App\Livewire\Contacts;

use App\Actions\Contacts\AugmentWithLinkedIn;
use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Show extends Component
{
    public Contact $contact;

    public $showContactEventModal = false;

    public $showContactForm = false;

    public $message = null;

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
        if (! $this->authorize('augmentWithLinkedIn', $this->contact)) {
            return;
        }

        $augmentedData = $augmentWithLinkedIn($this->contact);

        $this->contact->update([
            'general_notes' => $this->contact->general_notes."\n\n".$augmentedData['about'],
            'photo' => $augmentedData['profile_image_url'],
            'structured_metadata' => $augmentedData,
            'last_api_update' => now(),
        ]);
    }

    #[Computed]
    public function linkedinDisabled()
    {
        return ! $this->contact->linkedin || ($this->contact->linkedin && ! is_null($this->contact->last_api_update) && $this->contact->last_api_update?->diffInHours(now()) < 24);
    }

    #[Computed]
    public function linkedinDisabledMessage()
    {
        return ! $this->contact->linkedin ?
            'A LinkedIn Profile is required' :
            'You can only augment a contact with LinkedIn data once every 24 hours.';
    }
}
