<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use App\Livewire\Shared\Modal as SharedModal;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Modal extends Component
{
    public ContactForm $form;

    public Collection $contact_methods;

    #[Reactive]
    public bool $showModal = false;

    public bool $editMode = false;

    public function mount(?Contact $contact)
    {
        if ($contact->id) {
            $this->form->setContact($contact);
            $this->editMode = true;
        } else {
            $this->form->preferred_contact_method = ContactMethod::where('name', 'Email')->first()->id;
        }

        $this->contact_methods = ContactMethod::all();
    }

    public function store()
    {
        $contact = $this->form->store();

        $message = $contact->wasRecentlyCreated ? 'Contact successfully created.' : 'Contact successfully updated.';

        session()->flash('message', $message);

        $this->dispatch('contact-created-or-updated', $contact->id)->to(SharedModal::class);

        // @TODO I have a bug where the modal doesn't get filled in with the new contact on first load
        // reloading the page fixes it. For the time being I'm simply redirecting to the contact index page
        $contact->wasRecentlyCreated ? $this->redirectRoute('contacts.index') : $this->redirectRoute('contacts.show', $contact);
    }

    public function render(): View
    {
        return view('livewire.contacts.modal');
    }

    #[On('company-selected')]
    public function setCompany($company_id)
    {
        $this->form->company_id = $company_id;
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }
}
