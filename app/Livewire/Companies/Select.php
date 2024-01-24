<?php

namespace App\Livewire\Companies;

use App\Livewire\Contacts\Modal;
use Illuminate\Support\Collection;
use Livewire\Component;

class Select extends Component
{
    public Collection $companies;

    public int $company_id;

    public function render()
    {
        return view('livewire.companies.select')->with(['companies' => $this->companies]);
    }

    public function setCompany($company_id)
    {
        $this->dispatch('company-selected', $company_id)->to(Modal::class);
    }

    public function mount(Collection $companies)
    {
        $this->companies = $companies;
    }
}
