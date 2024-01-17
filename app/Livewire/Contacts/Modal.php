<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use App\Livewire\Shared\Modal as SharedModal;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public ContactForm $form;

    public Collection $contact_methods;

    public bool $editMode = false;

    public function mount(?Contact $model = null)
    {
        if ($model->id) {
            $this->form->setContact($model);
        }

        $this->contact_methods = ContactMethod::all();

        $this->editMode = $model->exists ?? false;
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
        return view('livewire.contacts.modal-form');
    }
}
