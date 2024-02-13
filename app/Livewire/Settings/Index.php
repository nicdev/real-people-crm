<?php

namespace App\Livewire\Settings;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public $title = 'Settings';

    #[Validate('required|string|max:255')]
    public $name;

    public $email;

    #[Validate('nullable|string|max:10000')]
    public $introduction;

    public function render()
    {
        return view('livewire.settings.index');
    }

    public function mount()
    {
        $this->setValues();
    }

    public function updateUser()
    {
        $this->authorize('update', auth()->user());

        $this->validate();

        auth()
            ->user()
            ->update([
                'name' => $this->name,
                'email' => $this->email,
                'custom_introduction_message' => $this->introduction,
            ]);

        session()->flash('message', 'Settings updated.');

        return redirect()->route('settings');
    }

    public function deleteUser()
    {
        $this->authorize('delete', auth()->user());

        auth()->user()->contactEvents()->delete();
        auth()->user()->companies()->delete();
        auth()->user()->contacts()->delete();

        auth()->user()->delete();

        return redirect()->route('login');
    }

    public function setValues()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->introduction = auth()->user()->custom_introduction_message ?? '';
    }

    public function connectToGoogle()
    {
        $this->authorize('update', auth()->user());

        redirect()->route('auth.google.redirect');
    }

    public function appendToIntroduction($message)
    {
        $this->dispatch('append-to-introduction', $message);
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
        ];
    }
}
