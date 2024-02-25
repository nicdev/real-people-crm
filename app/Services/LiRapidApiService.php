<?php

namespace App\Services;

class LiRapidApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new HttpService(config('services.linkedin_rapid_api.url'));
        $this->client->headers['headers'] = [
            'X-RapidAPI-Host' => config('services.linkedin_rapid_api.host'),
            'X-RapidAPI-Key' => config('services.linkedin_rapid_api.api_key'),
        ];
    }

    public function getProfile($contact)
    {
        return $this->client->get('', [
            'api_key' => config('services.linkedin_rapid_api.api_key'),
            'linkedin_url' => $contact->linkedin,
        ]);
    }
}
