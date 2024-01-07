<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;

class Show extends Component
{
    public Company $company;

    public function render()
    {
        return view('livewire.companies.show');
    }
}
