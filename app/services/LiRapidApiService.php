<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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

    /**
     * Makes an API call
     */
    // public function post(string $endpoint, bool $async = false, array $params = []): array
    // {
    //     $url = $async ? config('services.linkedin_rapid_api.async').'/'.$endpoint : config('services.linkedin_rapid_api.api').'/'.$endpoint;
    //     ray($url);
    //     $headers = [
    //         'X-RapidAPI-Host' => config('services.linkedin_rapid_api.host'),
    //         'X-RapidAPI-Key' => config('services.linkedin_rapid_api.api_key'),
    //     ];
    //     ray($headers);

    //     $res = Http::withHeaders($headers)->post($url, $params);

    //     return $res->json() ?: null;
    // }

    public function getProfile($contact)
    {
        return $this->client->get('', [
            'api_key' => config('services.linkedin_rapid_api.api_key'),
            'linkedin_url' => $contact->linkedin,
        ]);
    }

    // public function get($endpoint, $async = false, $params = [])
    // {

    //     $url = $async ? config('services.linkedin_rapid_api.async').'/'.$endpoint : config('services.linkedin_rapid_api.api').'/'.$endpoint;

    //     $headers = [
    //         'X-RapidAPI-Host' => config('services.linkedin_rapid_api.host'),
    //         'X-RapidAPI-Key' => config('services.linkedin_rapid_api.api_key'),
    //     ];

    //     $this->headers['headers'] = $headers;

    //     ray(config('services.linkedin_rapid_api.url').'/'.$endpoint);
    //     $res = Http::withHeaders($headers)->get(config('services.linkedin_rapid_api.url').'/'.$endpoint, $params);

    //     return $res->json() ?? $res->body();
    // }
}
