<?php

namespace App\Livewire\Forms;

use App\Actions\Contacts\CreateOrUpdateContact;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    public ?Contact $contact;

    public Collection $companies;

    #[Validate('required|max:255|string')]
    public $first_name;

    #[Validate('nullable|max:255|string')]
    public $middle_name;

    #[Validate('required|max:255|string')]
    public $last_name;

    #[Validate('nullable|max:40|string')]
    public $phone;

    #[Validate('required|max:255|email')]
    public $email;

    #[Validate('nullable|max:255|url')]
    public $linkedin;

    #[Validate('nullable|max:255|url')]
    public $twitter;

    #[Validate('nullable|max:255|url')]
    public $youtube;

    #[Validate('nullable|max:255|url')]
    public $website;

    #[Validate('required')]
    public $preferred_contact_method;

    #[Validate('nullable|string|max:10000')]
    public $general_notes;

    #[Validate('nullable|exists:companies,id')]
    public $company_id;

    #[Validate('nullable|date')]
    public $follow_up_date;

    #[Validate('required|int')]
    public $frequency = 180;

    public function render(): View
    {
        return view('livewire.contacts.modal-form');
    }

    public function mount(?Contact $contact)
    {
        $this->companies = auth()->user()->companies;
        //$this->company_id = $this->contact?->company_id ?: $this->contact->company_id;
        $this->preferred_contact_method = $this->contact->preferredContactMethod ?? ContactMethod::whereName('Email')->first()->id;

        $this->contact = $contact;
    }

    public function store()
    {
        $this->validate();

        $contact = app(CreateOrUpdateContact::class)([
            'id' => isset($this->contact) ? $this->contact->id : null,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'website' => $this->website,
            'preferred_contact_method_id' => $this->preferred_contact_method,
            'general_notes' => $this->general_notes,
            'user_id' => auth()->id(),
            'company_id' => $this->company_id,
            'follow_up_date' => $this->follow_up_date,
            'frequency' => $this->frequency,
        ]);

        return $contact;
    }

    public function rules()
    {
        return [
            'company_id' => [
                'nullable',
                'integer',
                Rule::exists('companies', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
            'preferred_contact_method' => ['required', 'integer', Rule::exists('contact_methods', 'id')],
        ];
    }

    public function setContact(Contact $contact): void
    {
        $this->contact = $contact;

        $this->first_name = $contact->first_name;
        $this->middle_name = $contact->middle_name;
        $this->last_name = $contact->last_name;
        $this->phone = $contact->phone;
        $this->email = $contact->email;
        $this->linkedin = $contact->linkedin;
        $this->twitter = $contact->twitter;
        $this->youtube = $contact->youtube;
        $this->website = $contact->website;
        $this->preferred_contact_method = $contact->preferred_contact_method_id;
        $this->general_notes = $contact->general_notes;
        $this->company_id = $contact->company_id;
        $this->follow_up_date = $contact->follow_up_date;
        $this->frequency = $contact->frequency;

        // I like this better but it throws a warning for using dynamic properties.
        // Not sure why it considers them dynbamically set.
        //
        // foreach ($this->contact->getAttributes() as $key => $value) {
        //     $this->$key = $value;
        // }
    }

    #[On('company-selected')]
    public function setCompany($company_id)
    {
        $this->company_id = $company_id;
    }
}
