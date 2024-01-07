<?php

namespace App\Livewire\Companies;

use Illuminate\Support\Collection;
use Livewire\Component;

class Select extends Component
{
    public Collection $companies;

    public function render()
    {
        return view('livewire.companies.select')->with(['companies' => $this->companies]);
    }

    public function change($company_id)
    {
        ray('displaych company');
        $this->dispatch('company-selected', $company_id);
    }

    public function mount(Collection $companies)
    {
        $this->companies = $companies;
    }
}
