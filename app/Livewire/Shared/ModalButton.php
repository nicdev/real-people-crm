<?php

namespace App\Livewire\Shared;

use Illuminate\View\View;
use Livewire\Component;

class ModalButton extends Component
{
    public $model;

    public $label;

    public $methods = [];

    public function render(): View
    {
        return view('livewire.shared.modal-button', ['model' => $this->model]);
    }

    public function mount($model, $label)
    {
        $this->model = $model;
        $this->label = $label;
    }
}
