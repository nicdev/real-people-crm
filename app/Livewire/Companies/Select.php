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

    public function mount(Collection $companies, int $company_id = null)
    {
        $this->companies = $companies;
        $this->company_id = $company_id;
    }
    
    public function updated($key, $value)
    {
        if($key === 'company_id') {
            $this->dispatch('company-selected', $value);
        }
    }
}
