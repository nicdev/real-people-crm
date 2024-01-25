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

    public $showIntroduceContactsForm = false;

    public $importingContacts = false;

    public $search;

    public $title = 'Contacts';

    public function render()
    {
        $contacts = auth()->user()
            ->contacts()
            ->orderBy('first_name', 'asc')
            ->when($this->search, function ($query) {
                $searchTerm = strtolower(trim($this->search));
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->whereRaw('LOWER(first_name) LIKE ?', "%{$searchTerm}%")
                        ->orWhereRaw('LOWER(middle_name) LIKE ?', "%{$searchTerm}%")
                        ->orWhereRaw('LOWER(last_name) LIKE ?', "%{$searchTerm}%")
                        ->orWhereRaw('LOWER(email) LIKE ?', "%{$searchTerm}%")
                        ->orWhereRaw('LOWER(general_notes) LIKE ?', "%{$searchTerm}%")
                        ->orWhere('phone', 'like', "%{$searchTerm}%");
                });
            })
            ->paginate(15);

        $contacts->withPath('/contacts');

        return view('livewire.contacts.index')->with(compact('contacts'));
    }

    #[On('modal-closed')]
    public function closeModal()
    {
        $this->showContactForm = false;
        $this->showContactEventForm = false;
        $this->showIntroduceContactsForm = false;
    }

    public function delete(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        session()->flash('message', 'Contact successfully deleted.');
    }

    public function importFromGoogle()
    {
        $this->importingContacts = true;

        ImportContactsFromGoogle::dispatch(Auth::user()->id);
    }

    public function importFromLinkedin()
    {
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
