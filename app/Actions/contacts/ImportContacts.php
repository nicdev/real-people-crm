<?php

namespace App\Actions\Contacts;

class ImportContacts
{
    public function __invoke(array $contacts, $user)
    {
        foreach ($contacts as $contact) {
            $contact = $this->cleanContact($contact);

            if ($contact !== null) {
                $user->contacts()->updateOrCreate([
                    'email' => $contact['email'],
                ], $contact);
            }
        }

    }

    protected function cleanContact(array $contact)
    {
        if (! isset($contact['emailAddresses'][0]['value'])) {
            return null;
        }

        if (! isset($contact['names'][0]['displayName']) && ! isset($contact['names'][0]['givenName']) && ! isset($contact['names'][0]['familyName'])) {
            return null;
        }

        return [
            'email' => $contact['emailAddresses'][0]['value'],
            'first_name' => $contact['names'][0]['givenName'] ?? null,
            'last_name' => $contact['names'][0]['familyName'] ?? null,
            'display_name' => $contact['names'][0]['displayName'] ?? null,
            'photo' => $contact['photos'][0]['url'] ?? null,
            'birthday' => $contact['birthdays'][0]['date'] ?? null,
        ];
    }
}
