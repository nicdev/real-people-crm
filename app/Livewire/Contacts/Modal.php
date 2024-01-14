<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Modal extends Component
{
    public ContactForm $form;

    public Collection $contact_methods;

    public bool $editMode = false;

    public function mount(?Contact $model = null)
    {
        if ($model !== null) {
            $this->form->setContact($model);
        }

        $this->contact_methods = ContactMethod::all();

        $this->editMode = $model->exists ?? false;
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
