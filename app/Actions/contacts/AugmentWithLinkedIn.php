<?php

namespace App\Actions\Contacts;

use App\Models\Contact;
use App\Services\ScraperApiService;

class AugmentWithLinkedIn
{
    public function __invoke(Contact $contact)
    {
        $client = new ScraperApiService(config('services.scraperapi.api_key'));
        
        $client->get([
            // 'https://www.linkedin.com/in/'.$contact->linkedin,
            $contact->linkedin,
        ]);
    }
}
