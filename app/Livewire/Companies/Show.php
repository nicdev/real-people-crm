<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Company $company;

    public bool $showCompanyForm = false;

    public bool $showContactForm = false;

    public string $title = 'Contact';

    public function render()
    {
        return view('livewire.companies.show');
    }

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->title = $company->name;
    }

    public function removeFromCompany($contactId)
    {
        $contact = Contact::find($contactId);
        $contact->company()->dissociate();
        $contact->save();
        $this->company->refresh();
    }

    public function delete()
    {
        $this->company->delete();

        session()->flash('success', 'Company deleted successfully');

        return redirect()->route('companies.index');
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showCompanyForm = false;

        $this->showContactForm = false;
    }
}
