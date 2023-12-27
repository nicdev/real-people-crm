<?php

namespace App\Livewire\Companies;

use App\Actions\Contacts\CreateContact;
use App\Http\Requests\StoreContactRequest;
use App\Models\Company;
use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Delete extends Component {

    public $company;
    
    public function render() {
        return view('livewire.companies.delete');
    }

    public function mount(Company $company) {
        $this->contact = $company;
    }
    
    public function delete() {
        $this->company->delete();

        session()->flash('message', 'Company successfully deleted.');

        return redirect()->route('companies.index');
    }
}