<?php

namespace App\Livewire\Shared;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Modal extends Component
{
    public string $component;

    #[Reactive]
    public bool $showModal;

    public mixed $model;

    public function mount(string $component, bool $showModal = true, mixed $model = null)
    {
        $this->component = $component;
        // $this->showModal = $showModal;
        $this->model = $model;
    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }
}
