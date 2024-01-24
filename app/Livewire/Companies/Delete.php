<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class Delete extends Component
{
    public $company;

    public function render()
    {
        return view('livewire.companies.delete');
    }

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function delete()
    {
        $this->company->delete();

        session()->flash('message', 'Company successfully deleted.');

        return redirect()->route('companies.index');
    }
}
