<?php

namespace App\Services;

use App\Models\Contact;
use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.api_key'));
    }

    public function getConversationSummary(Contact $contact)
    {
        $contactEvents = $contact->contactEvents()->get();
        $contactEventsRaw = $contactEvents->reduce(function ($carry, $event) {
            return $carry . 'Contact via: ' . $event->contactMethod->name . ': ' . $event->recap . ' ';
        }, '');
        return $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'The following are contact events between me and my contact: ' . $contact->name. '. Make a summary and suggest a follow-up action. Use the format: Summary: [summary] Follow-up: [follow-up action]. Here is the summary of all the events:' . $contactEventsRaw,
                ],
            ]
        ]);
    }
}
