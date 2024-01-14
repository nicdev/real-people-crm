<?php

namespace App\Livewire\ContactEvents;

use App\Actions\ContactEvents\CreateOrUpdateContactEvent;
use App\Models\Contact;
use App\Models\ContactEvent;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public Contact $contact;

    public ContactEvent $contact_event;

    public Collection $contact_methods;

    #[Validate('required|max:255|string')]
    public $name;

    #[Validate('max:255|string')]
    public $description;

    #[Validate('required|max:255|string')]
    public $date;

    #[Validate('max:255|string')]
    public $location;

    #[Validate('required|integer')]
    public $contact_id;

    #[Validate('required|integer')]
    public $contact_method_id;

    #[Validate('max:255|string')]
    public $recap;

    public function render(): View
    {
        return view('livewire.contact-events.modal-form');
    }

    public function mount(?ContactEvent $contactEvent, ?Contact $contact)
    {
        $this->contact_event = $contactEvent ?? null;
        $this->contact = $contact;
        $this->contact_method_id = $this->contact?->preferredContactMethod ? $this->contact->preferredContactMethod->id : ContactMethod::where('name', 'Email')->first()->id;
        $this->contact_methods = ContactMethod::all();
        $this->date = $this->contact_event?->date ?: now()->format('Y-m-d');
    }

    public function store(CreateOrUpdateContactEvent $createOrUpdateContactEvent)
    {
        $this->contact_event = $createOrUpdateContactEvent([
            'id' => $this->contact_event?->id,
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'location' => $this->location,
            'contact_id' => $this->contact->id,
            'contact_method_id' => $this->contact_method_id,
            'recap' => $this->recap,
        ]);

        session()->flash('message', 'Contact Event successfully created.');

        return redirect()->route('contacts.show', $this->contact_event->contact_id);
    }

    #[On('updated-contact-id')]
    public function updateContactId($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    #[Computed]
    public function contactMethod()
    {
        return $this->contact_method_id ? ContactMethod::find($this->contact_method_id)->name : null;
    }

    #[Computed]
    public function title()
    {
        return $this->contact->first_name.' via '.$this->contactMethod();
    }
}