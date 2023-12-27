<?php

namespace App\Actions\Contacts;

use Illuminate\Support\Facades\Auth;

class ImportContacts {
    public function __invoke(array $contacts) {
        $user = Auth::user();

        foreach($contacts as $contact) { 
            $contact = $this->cleanContact($contact);

            if($contact !== null) {
                $user->contacts()->updateOrCreate([
                    'email' => $contact['email'],
                ], $contact);
            }
        }

        return;
    }

    protected function cleanContact(array $contact) {
        if(!isset($contact['emailAddresses'][0]['value'])) {
            return null;
        }

        if(!isset($contact['names'][0]['displayName']) && !isset($contact['names'][0]['givenName']) && !isset($contact['names'][0]['familyName'])) {
            return null;
        }

        return [
            'email' => $contact['emailAddresses'][0]['value'],
            'first_name' => $contact['names'][0]['givenName'] ?? null,
            'last_name' => $contact['names'][0]['familyName'] ?? null,
            'display_name' => $contact['names'][0]['displayName'] ?? null,
        ];
    }
}