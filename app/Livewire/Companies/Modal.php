<?php

namespace App\Livewire\Companies;

use App\Actions\Companies\CreateOrUpdateCompany;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Modal extends Component
{
    public Company $company;

    public bool $editMode = false;

    #[Reactive]
    public bool $showModal = false;

    #[Validate('required|max:255|string')]
    public $name;

    #[Validate('nullable|max:40|string')]
    public $phone;

    #[Validate('nullable|max:255|email')]
    public $email;

    #[Validate('nullable|max:255|url')]
    public $linkedin;

    #[Validate('nullable|max:255|url')]
    public $twitter;

    #[Validate('nullable|max:255|url')]
    public $youtube;

    #[Validate('nullable|max:255|url')]
    public $website;

    #[Validate('nullable|string|max:10000')]
    public $notes;

    public function render(): View
    {
        return view('livewire.companies.modal');
    }

    public function mount(?Company $company)
    {
        if ($company->id) {
            $this->setCompany($company);
            $this->editMode = true;
        }

        $this->company = $company ?? null;
    }

    public function store(CreateOrUpdateCompany $createOrUpdateCompany)
    {
        if ($this->company?->id) {
            $this->authorize('update', $this->company);
        } else {
            $this->authorize('create', Company::class);
        }

        $this->validate();

        $company = $createOrUpdateCompany([
            'id' => $this->company?->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'website' => $this->website,
            'notes' => $this->notes,
            'user_id' => auth()->id(),
        ]);

        $message = $company->wasRecentlyCreated ? 'Company successfully created.' : 'Company successfully updated.';
        session()->flash('message', $message);

        $company->wasRecentlyCreated ? $this->redirectRoute('companies.index') : $this->redirectRoute('companies.show', $company);
    }

    public function setCompany(Company $company)
    {
        $this->name = $company->name;
        $this->phone = $company->phone;
        $this->email = $company->email;
        $this->linkedin = $company->linkedin;
        $this->twitter = $company->twitter;
        $this->youtube = $company->youtube;
        $this->website = $company->website;
        $this->notes = $company->notes;
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }
}
