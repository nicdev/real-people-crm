<?php

namespace App\Livewire\Contacts;

use App\Jobs\ImportContactsFromGoogle;
use App\Jobs\ImportContactsFromLinkedin;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showContactForm = false;

    public $showContactEventForm = false;

    public $importingContacts = false;

    public $search;

    // public function mount(bool $showContactForm = false)
    // {
    //     // ray($showContactForm);
    //     // $this->showContactForm = $showContactForm;
    //     // ray($this->showContactForm);
    // }

    public function render()
    {
        $contacts = auth()->user()
            ->contacts()
            ->orderBy('first_name', 'asc')
            ->when($this->search, function ($query) {
                $query->where('first_name', 'like', "%{$this->search}%")
                    ->orWhere('middle_name', 'like', "%{$this->search}%")
                    ->orWhere('last_name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%")
                    ->orWhere('general_notes', 'like', "%{$this->search}%");
            })
            ->paginate(15);

        return view('livewire.contacts.index')->with(compact('contacts'));
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showContactForm = false;
        $this->showContactEventForm = false;
    }

    public function delete(Contact $contact)
    {
        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');

        return redirect()->route('contacts.index');
    }

    public function importFromGoogle()
    {
        $this->importingContacts = true;

        ImportContactsFromGoogle::dispatch(Auth::user()->id);
    }

    public function importFromLinkedin()
    {
        ray('importFromLinkedin cliocked');
        $this->importingContacts = true;

        ImportContactsFromLinkedin::dispatch(Auth::user()->id);
    }

    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }
}
