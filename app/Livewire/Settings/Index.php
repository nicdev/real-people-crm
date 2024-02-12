<?php

namespace App\Livewire\Settings;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public $title = 'Settings';

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('email|required|string|max:255|unique:users')]
    public $email;

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

        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
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
    }

    public function connectToGoogle()
    {
        $this->authorize('update', auth()->user());

        redirect()->route('auth.google.redirect');
    }
}
