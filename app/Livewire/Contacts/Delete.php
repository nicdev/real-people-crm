<?php

namespace App\Livewire\Contacts;

use App\Actions\Contacts\CreateContact;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Delete extends Component {

    public $contact;
    
    public function render() {
        return view('livewire.contacts.delete');
    }

    public function mount(Contact $contact) {
        $this->contact = $contact;
    }
    
    public function delete() {
        $this->contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }
}