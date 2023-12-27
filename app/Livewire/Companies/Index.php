<?php

namespace App\Livewire\Companies;

use App\Models\Contact;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $companies = auth()->user()->companies ?? [];

        return view('livewire.companies.index')->with(compact('companies'));
    }

    public function delete(Contact $company)
    {
        $company->delete();

        session()->flash('message', 'Company successfully deleted.');

        return redirect()->route('companies.index');
    }
}
