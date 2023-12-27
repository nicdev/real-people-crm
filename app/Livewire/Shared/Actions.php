<?php

namespace App\Livewire\Shared;

use Illuminate\View\View;
use Livewire\Component;

class Actions extends Component
{
    public $model;

    public function render(): View
    {
        return view('livewire.shared.actions', ['model' => $this->model]);
    }

    public function mount($model)
    {
        $this->model = $model;
    }
}
