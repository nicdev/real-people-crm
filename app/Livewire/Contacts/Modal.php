<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public ContactForm $form;

    public Collection $contact_methods;

    public function mount(?Contact $contact)
    {
        if ($contact) {
            $this->form->setContact($contact);
        }

        $this->contact_methods = ContactMethod::all();
    }

    public function store()
    {
        $this->form->store();
    }

    public function render(): View
    {
        return view('livewire.contacts.modal-form');
    }
}
