<?php

namespace App\Livewire\Companies;

use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $showCompanyForm = false;

    public function render()
    {
        $companies = auth()->user()->companies ?? [];

        return view('livewire.companies.index')->with(['companies' => $companies, 'title' => 'Companies']);
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showCompanyForm = false;
    }

    public function delete(Contact $company)
    {
        $this->authorize('delete', $company);
        
        $company->delete();

        session()->flash('message', 'Company successfully deleted.');

        return redirect()->route('companies.index');
    }
}
