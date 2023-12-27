<?php

namespace App\Livewire\Companies;

use App\Actions\Companies\CreateOrUpdateCompany;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public Company $company;

    public Collection $companies;

    #[Validate('required|max:255|string')]
    public $name;

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

    #[Validate('required|string|max:10000')]
    public $general_notes;

    public function render(): View
    {
        return view('livewire.companies.modal-form');
    }

    public function mount(Company $company)
    {
        $this->company = $company ?? new company();
        $this->companies = $companies ?? new Collection();

        $this->name = $company->name;
        $this->phone = $company->phone;
        $this->email = $company->email;
        $this->linkedin = $company->linkedin;
        $this->twitter = $company->twitter;
        $this->youtube = $company->youtube;
        $this->website = $company->website;
        $this->general_notes = $company->general_notes;
    }

    public function store(CreateOrUpdateCompany $createOrUpdateCompany)
    {
        $createOrUpdateCompany([
            'id' => $this->company?->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'website' => $this->website,
            'general_notes' => $this->general_notes,
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', 'Company successfully created.');

        return redirect()->route('companies.index');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
