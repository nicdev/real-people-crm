<?php

namespace App\Livewire\Contacts;

use App\Actions\Contacts\CreateOrUpdateContact;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent 
{
    public Contact $contact;
    public Collection $companies;
    
    #[Validate('required|max:255|string')]
    public $first_name;
    #[Validate('required|max:255|string')]
    public $middle_name;
    #[Validate('required|max:255|string')]
    public $last_name;
    #[Validate('required|max:40|string')]
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
    #[Validate('required|string')]
    public $preferred_contact_method = 'Email';
    #[Validate('required|string|max:10000')]
    public $general_notes;
    public $company_id;

    public function render(): View
    {
        return view('livewire.contacts.modal-form');
    }

    public function mount(Contact $contact, Collection $companies) {
        $this->contact = $contact ?? new Contact();
        $this->companies = auth()->user()->companies ?? new Collection();

        $this->first_name = $contact->first_name;
        $this->middle_name = $contact->middle_name;
        $this->last_name = $contact->last_name;
        $this->phone = $contact->phone;
        $this->email = $contact->email;
        $this->linkedin = $contact->linkedin;
        $this->twitter = $contact->twitter;
        $this->youtube = $contact->youtube;
        $this->website = $contact->website;
        $this->preferred_contact_method = $contact->preferred_contact_method;
        $this->general_notes = $contact->general_notes;
        $this->company_id = $contact->company_id;
    }

    public function store(CreateOrUpdateContact $createOrUpdateContact) {
        $createOrUpdateContact([
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
            'preferred_contact_method' => $this->preferred_contact_method,
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
}