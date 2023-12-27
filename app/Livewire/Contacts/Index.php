<?php

namespace App\Livewire\Contacts;

use App\Actions\Contacts\CreateContact;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component {

    public function render() {
        $contacts = auth()->user()->contacts;
        
        return view('livewire.contacts.index')->with(compact('contacts'));
    }

    public function delete(Contact $contact) {
        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }
}