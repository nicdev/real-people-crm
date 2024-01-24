<?php

namespace App\Livewire\Introductions;

use App\Actions\Introductions\CreateIntroduction;
use App\Models\Contact;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Modal extends Component
{
    #[Reactive]
    public $showModal = false;

    public $first_contact;

    public $second_contact;

    public $introduction;

    public $introductionCustomized = false;

    public $originalText = <<<'HTML'
    <div>
        <p class="mb-2">Hi %s and %s,<p>
        <p class="mb-2">I wanted to introduce you two. I think you both could benefit from connecting. Feel free to reach out to each other directly.</p>
        <p class="mb-2">Best,</p>
        <p class="mb-8"><em>%s</em></p>
        <em>Introduction sent via <a href="%s" class="underline">%s.</a></em>
    </div>
    HTML;

    public function render()
    {
        $contacts = auth()->user()
            ->contacts()
            ->orderBy('first_name', 'asc')
            ->get();

        return view('livewire.introductions.modal')->with(compact('contacts'));
    }

    public function mount()
    {
        $this->introduction = sprintf($this->originalText, $this->first_contact?->first_name ?? '________', $this->second_contact?->first_name ?? '________', auth()->user()->name, env('APP_URL'), env('APP_NAME'));
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }

    public function updated($property)
    {
        if ($property === 'first_contact' || $property === 'second_contact') {
            $firstContactName = auth()->user()->contacts()->where('id', $this->first_contact)->first()?->first_name ?? '________';
            $secondContactName = auth()->user()->contacts()->where('id', $this->second_contact)->first()?->first_name ?? '________';

            $this->introduction = sprintf(
                $this->originalText,
                $firstContactName,
                $secondContactName,
                auth()->user()->name,
                env('APP_URL', 'https://realpeoplecrm.com'),
                env('APP_NAME')
            );
        }
    }

    public function sendIntroduction(CreateIntroduction $createIntroduction)
    {
        $this->authorize('create', Contact::find($this->first_contact), Contact::find($this->second_contact));
        
        $createIntroduction([
            'first_contact_id' => $this->first_contact,
            'second_contact_id' => $this->second_contact,
            'user_id' => auth()->id(),
            'content' => $this->introduction,
        ]);

        session()->flash('message', 'Introduction successfully sent.');

        $this->closeModal();
    }
}
