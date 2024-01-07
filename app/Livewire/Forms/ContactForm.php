<?php

namespace App\Livewire\Forms;

use App\Actions\Contacts\CreateOrUpdateContact;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    public ?Contact $contact;

    public Collection $companies;
    
    #[Validate('required|max:255|string')]
    public $first_name;

    #[Validate('required|max:255|string')]
    public $middle_name;

    #[Validate('required|max:255|string')]
    public $last_name;

    #[Validate('max:40|string')]
    public $phone;

    #[Validate('required|max:255|email')]
    public $email;

    #[Validate('required|max:255|url')]
    public $linkedin;

    #[Validate('required|max:255|url')]
    public $twitter;

    #[Validate('required|max:255|url')]
    public $youtube;

    #[Validate('required|max:255|url')]
    public $website;

    #[Validate('required|exists:contact_methods')]
    public $preferred_contact_method_id = '';

    #[Validate('required|string|max:10000')]
    public $general_notes;

    public $company_id;

    public function render(): View
    {
        return view('livewire.contacts.modal-form');
    }

    public function mount()
    {
        $this->companies = auth()->user()->companies;
        $this->company_id = $this->contact->company_id;
        $this->preferred_contact_method_id = $this->contact->preferredContactMethod;
    }

    public function store()
    {
        app(CreateOrUpdateContact::class)([
            'id' => $this->contact?->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'website' => $this->website,
            'preferred_contact_method_id' => $this->preferred_contact_method_id,
            'general_notes' => $this->general_notes,
            'user_id' => auth()->id(),
            'company_id' => $this->company_id,
        ]);

        session()->flash('message', 'Contact successfully created.');

        return redirect()->route('contacts.index');
    }

    public function rules()
    {
        return [
            // Custom rule for company_id
            'company_id' => [
                'required',
                'integer',
                Rule::exists('companies', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
        ];
    }

    public function setContact(Contact $contact): void 
    {
        $this->contact = $contact;
    } 
}
