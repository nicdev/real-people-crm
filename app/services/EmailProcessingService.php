<?php

namespace App\Services;

use App\Models\User;

class EmailProcessingService
{
    public function __construct(public array $email)
    {
        $this->email = $email;
    }

    public function isForward(): bool
    {
        return (bool) preg_match('/forwarded message/i', $this->email['body-plain']);
    }

    public function getOriginalSender(): array|null
    {

        // Perform the regex match
        if ($this->isForward()) {
            if (preg_match('/From: (.+?) <.+?>/', $this->email['body-plain'], $matches)) {
                $contact = $this->nameParts(trim($matches[1]));
            }

            if (preg_match('/(?:<|&lt;)(.+?)(?:>|&gt;)/', $this->email['body-plain'], $matches)) {
                $contact['email'] = trim($matches[1]);
            }
        } else {
            return $this->getSender();
        }

        ray($contact);

        return $contact['email'] ? $contact : null;
    }

    public function getSender(): array
    {

        $contact = preg_match('/(.+?) <.+?>/', $this->email['from'], $matches) ? $this->nameParts(trim($matches[1])) : [];
        $contact['email'] = preg_match('/(?:<|&lt;)(.+?)(?:>|&gt;)/', $this->email['from'], $matches) ? trim($matches[1]) : null;

        return $contact;
    }

    public function getRecipient(): array
    {
        return [
            'name' => preg_match('/(.+?) <.+?>/', $this->email['To'], $matches) ? trim($matches[1]) : 'No Name Provided',
            'email' => preg_match('/(?:<|&lt;)(.+?)(?:>|&gt;)/', $this->email['To'], $matches) ? trim($matches[1]) : null,
        ];
    }

    public function getSenderUser(): User|null
    {
        if ($emailAddress = $this->getSender()['email']) {
            return User::where('email', $emailAddress)->first();
        }
        return null;
    }

    private function nameParts(string $name): array
    {
        // Remove the word `at` and the `@` symbol to avoid those Nic at Punchlist
        // sender names to being part of the last name
        $name = str_replace([' at ', '@'], ' ', $name);

        $parts = explode(' ', $name);

        return [
            'first_name' => array_shift($parts),
            'last_name' => implode(' ', $parts),
        ];
    }
}
