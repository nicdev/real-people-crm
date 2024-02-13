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

    public $editIntro = false;

    public $first_contact;

    public $second_contact;

    public $introduction;

    public $introductionCustomized = false;

    public $originalText = <<<'HTML'
    <div>
        <p style="margin-bottom:5px">Hi FIRST_CONTACT_FIRST_NAME and SECOND_CONTACT_FIRST_NAME,<p>
        <p style="margin-bottom:15px">I wanted to introduce you two. I think you both could benefit from connecting. Feel free to reach out to each other directly.</p>
        <p style="margin-bottom:15px">Best,</p>
        <p style="font-weight:bold"><em>USER_NAME</em></p>
        <em>Introduction sent via <a href="%s">APP_URL.</a></em>
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
        $this->resetIntroMessage();
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }

    public function updated($property)
    {
        if ($property === 'first_contact' || $property === 'second_contact') {
            $firstContact = auth()->user()->contacts()->where('id', $this->first_contact)->first();
            $secondContact = auth()->user()->contacts()->where('id', $this->second_contact)->first();

            if($firstContact) {
                $this->introduction = str_replace('FIRST_CONTACT_FIRST_NAME', $firstContact->first_name, $this->introduction);
                $this->introduction = str_replace('FIRST_CONTACT_LAST_NAME', $firstContact->last_name, $this->introduction);    
            }

            if($secondContact) {
                $this->introduction = str_replace('SECOND_CONTACT_FIRST_NAME', $secondContact->first_name, $this->introduction);
                $this->introduction = str_replace('SECOND_CONTACT_LAST_NAME', $secondContact->last_name, $this->introduction);
            }

            $this->introduction = str_replace('APP_URL', env('APP_URL', 'https://realpeoplecrm.com'), $this->introduction);
            $this->introduction = str_replace('APP_NAME', env('APP_NAME'), $this->introduction);

            $this->introduction = str_replace('USER_NAME', auth()->user()->name, $this->introduction);

            $this->introductionCustomized = true;
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

    public function toggleEditIntro()
    {
        $this->editIntro = !$this->editIntro;
    }

    public function resetIntroMessage()
    {
        $this->introduction = auth()->user()->custom_introduction_message ?: sprintf($this->originalText, $this->first_contact?->first_name ?? 'FIRST_CONTACT_FIRST_NAME', $this->second_contact?->first_name ?? 'SECOND_CONTACT_FIRST_NAME', auth()->user()->name, env('APP_URL'), env('APP_NAME'));
    }
}
