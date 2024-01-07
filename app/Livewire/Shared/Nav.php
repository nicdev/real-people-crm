<?php

namespace App\Livewire\Shared;

use Illuminate\View\View;
use Livewire\Component;

class Nav extends Component
{
    public bool $showUserMenu = false;

    public function render(): View
    {
        return view('livewire.shared.nav');
    }
}
