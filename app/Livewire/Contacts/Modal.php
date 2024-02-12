<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
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

    public function mount(?Contact $contact, ?int $companyId = null)
    {
        if ($contact->id) {
            $this->form->setContact($contact);
            $this->editMode = true;
        } else {
            $this->form->preferred_contact_method = ContactMethod::where('name', 'Email')->first()->id;
        }

        if ($companyId) {
            $this->form->company_id = $companyId;
        }

        $this->contact_methods = ContactMethod::all();
    }

    public function store()
    {
        if (isset($this->form->contact)) {
            $this->authorize('update', $this->form->contact);
        } else {
            $this->authorize('create', Contact::class);
        }

        $contact = $this->form->store();

        $message = $contact->wasRecentlyCreated ? 'Contact successfully created.<a class="button" href="'.route('contacts.show', $contact).'"> See contact</a>.' : 'Contact successfully updated.';

        session()->flash('message', $message);

        // @TODO I have a bug where the modal doesn't get filled in with the new contact on first load
        // reloading the page fixes it. For the time being I'm simply redirecting to the contact index page
        $contact->wasRecentlyCreated ? $this->redirectRoute('contacts.index') : $this->redirectRoute('contacts.show', $contact);
    }

    public function render(): View
    {
        return view('livewire.contacts.modal');
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }

    #[On('company-selected')]
    public function setCompany($company_id)
    {
        $this->form->company_id = $company_id;
    }

    public function updated($key, $value)
    {
        match ($key) {
            'form.linkedin' => $this->form->linkedin = formatPersonLinkedInUrl($value),
            'form.twitter' => $this->form->twitter = formatTwitterUrl($value),
            'form.website' => $this->form->website = formatWebsiteUrl($value),
            default => null,
        };
    }
}
