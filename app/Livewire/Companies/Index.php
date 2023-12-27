<?php

namespace App\Livewire\Companies;

use App\Actions\Contacts\CreateContact;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component {

    public function render() {
        $companies = auth()->user()->companies ?? [];
        
        return view('livewire.companies.index')->with(compact('companies'));
    }

    public function delete(Contact $company) {
        $company->delete();

        session()->flash('message', 'Company successfully deleted.');

        return redirect()->route('companies.index');
    }
}