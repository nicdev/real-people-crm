<?php

namespace App\Livewire\ContactEvents;

use App\Models\Contact;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $contactEvents = auth()->user()->contactEvents()->orderBy('updated_at', 'desc')->limit(5)->get();

        return view('livewire.contact-events.index')->with(compact('contactEvents'));
    }

    public function delete(Contact $contact)
    {
        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }
}
