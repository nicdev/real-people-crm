<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LiRapidApiService
{
    public function __construct(protected string $apiKey)
    {
    }

    /**
     * Makes an API call
     */
    public function post(string $endpoint, bool $async = false, array $params = []): array
    {
        $url = $async ? config('services.linkedin_rapid_api.async').'/'.$endpoint : config('services.linkedin_rapid_api.api').'/'.$endpoint;

        $headers = [
            'X-RapidAPI-Host' => config('services.linkedin_rapid_api.host'),
            'X-RapidAPI-Key' => config('services.linkedin_rapid_api.api_key'),
        ];


        $res = Http::withHeaders($headers)->post($url, $params);

        return $res->json() ?: null;
    }

    public function get($endpoint, $async = false, $params = [])
    {
        ray($endpoint, $async, $params);
        $url = $async ? config('services.linkedin_rapid_api.async').'/'.$endpoint : config('services.linkedin_rapid_api.api').'/'.$endpoint;

        $headers = [
            'X-RapidAPI-Host' => config('services.linkedin_rapid_api.host'),
            'X-RapidAPI-Key' => config('services.linkedin_rapid_api.api_key'),
        ];

        $res = Http::withHeaders($headers)->get(config('services.linkedin_rapid_api.api').'/'.$endpoint, $params);

        return $res->json() ?? $res->body();
    }
}
