<?php

namespace App\Livewire\Companies;

use App\Actions\Contacts\CreateContact;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Select extends Component {

    public Collection $companies;

    public function render() {
        return view('livewire.companies.select')->with(['companies' => $this->companies]);
    }

    public function change($company_id) {
    $this->dispatch('company-selected', $company_id);
    }

    public function mount(Collection $companies) {
        $this->companies = $companies;
    }
}