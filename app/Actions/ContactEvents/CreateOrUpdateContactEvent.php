<?php

namespace App\Actions\ContactEvents;

use App\Models\ContactEvent;

class CreateOrUpdateContactEvent
{
    public function __invoke(array $contactEvent): ContactEvent
    {
        return ContactEvent::updateOrCreate(['id' => $contactEvent['id']], $contactEvent);
    }
}
