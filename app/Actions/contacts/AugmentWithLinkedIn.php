<?php

namespace App\Actions\Contacts;

use App\Models\Contact;
use App\Services\LiRapidApiService;
use App\Services\ScraperApiService;

class AugmentWithLinkedIn
{
    public function __invoke(Contact $contact)
    {
        // $client = new ScraperApiService(config('services.scraperapi.api_key'));
        $client = new LiRapidApiService(config('services.linkedin_rapid_api.api_key'));

        return $client->get(
            '',
            false,
            [
                'api_key' => config('services.scraperapi.api_key'),
                'url' => $contact->linkedin,
            ]  
        );
    }
}
