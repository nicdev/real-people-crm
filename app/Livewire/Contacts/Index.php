<?php

namespace App\Livewire\Contacts;

use App\Actions\Contacts\ImportContacts;
use App\Jobs\ImportContactsFromGoogle;
use App\Models\Contact;
use App\Services\GooglePeopleService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $showContactForm = false;

    public $showContactEventForm = false;

    public $importingContacts = false;

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

    public function importFromGoogle()
    {
        $this->importingContacts = true;

        ImportContactsFromGoogle::dispatch(Auth::user()->id);
    }
}
