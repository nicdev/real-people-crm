<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class CopyToClipboard extends Component
{
    public $elementId;

    public function render()
    {
        return view('livewire.shared.copy-to-clipboard');
    }

    public function mount($elementId)
    {
        $this->elementId = $elementId;
    }
}
