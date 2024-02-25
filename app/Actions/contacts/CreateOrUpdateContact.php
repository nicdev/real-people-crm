<?php

namespace App\Actions\Contacts;

use App\Models\Contact;

class CreateOrUpdateContact
{
    public function __invoke(array $contact): Contact
    {
        return Contact::updateOrCreate(['email' => $contact['email']], $contact);
    }
}
