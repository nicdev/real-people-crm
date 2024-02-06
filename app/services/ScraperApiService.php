<?php

namespace App\Services\ScraperApiService;

use Illuminate\Support\Facades\Http;

class ScraperApiService
{
    public function __construct(protected string $apiKey)
    {
    }

    /**
     * Makes an API call
     */
    public function post(string $endpoint, bool $async = false, array $params = []): array
    {
        $url = $async ? config('services.scraperapi.async').'/'.$endpoint : config('services.scraperapi.api').'/'.$endpoint;
        $res = Http::post($url, $params);

        return $res->json() ?: null;
    }

    public function get($endpoint, $async = false, $params = [])
    {
        $url = $async ? config('services.scraperapi.async').'/'.$endpoint : config('services.scraperapi.api').'/'.$endpoint;

        $res = Http::get(config('services.scraperapi.api').'/'.$endpoint, $params);

        return $res->json() ?? $res->body();
    }

    public function batchWithWebhook(array $urls, array $apiParams = [])
    {
        $payload = [
            'apiKey' => config('services.scraperapi.api_key'),
            'urls' => $urls,
            'apiParams' => [
                'autoparse' => isset($apiParams['autoparse']) ? $apiParams['autoparse'] : false,
                'country_code' => isset($apiParams['country_code']) ? $apiParams['country_code'] : 'us',
                'device_type' => isset($apiParams['device_type']) ? $apiParams['device_type'] : 'desktop',
                'follow_redirect' => isset($apiParams['follow_redirect']) ? $apiParams['follow_redirect'] : true,
                'premium' => isset($apiParams['premium']) ? $apiParams['premium'] : false,
                'render' => isset($apiParams['render']) ? $apiParams['render'] : false,
                'retry_404' => isset($apiParams['retry_404']) ? $apiParams['retry_404'] : false,
            ],
            'callback' => [
                'type' => 'webhook',
                'url' => config('services.scraperapi.webhook_url'),
            ],
        ];

        $res = $this->post('batchjobs', true, $payload);

        return $res;
    }

    public function account()
    {
        return $this->get('account', false, [
            'api_key' => config('services.scraperapi.api_key'),
        ]);
    }

    public function singleSite($url, $options = [])
    {
        return $this->get('', false, [
            'api_key' => config('services.scraperapi.api_key'),
            'url' => $url,
            ...$options,
        ]);
    }

    /**
     * Makes a structured Google Search API call
     */
    public function googleSearch(string $query, string $countryCode = 'us', string $tld = 'us'): array
    {
        $url = config('services.scraperapi.api').'/structured/google/search';
        $params = [
            'api_key' => $this->apiKey,
            'query' => $query,
            'country_code' => $countryCode,
            'tld' => $tld,
        ];

        $res = Http::get($url, $params);

        return $res->json() ?? $res->body();
    }

    /**
     * Makes a structured Twitter Search API call
     */
    public function twitterSearch(string $query, string $nextCursor = null): array
    {
        $url = config('services.scraperapi.api').'/structured/twitter/v2/search';
        $params = [
            'api_key' => $this->apiKey,
            'query' => $query,
        ];

        if (! is_null($nextCursor)) {
            $params['next_cursor'] = $nextCursor;
        }

        $res = Http::get($url, $params);

        return $res->json() ?? $res->body();
    }

    /**
     * Retrieves information for a Twitter profile
     */
    public function twitterProfile(string $user): array
    {
        $url = config('services.scraperapi.api').'/structured/twitter/v2/profile';
        $params = [
            'api_key' => $this->apiKey,
            'user' => $user,
        ];

        $res = Http::get($url, $params);

        return $res->json() ?? $res->body();
    }

    /**
     * Retrieves tweets for a given Twitter profile
     */
    public function twitterTweets(string $userId, string $nextCursor = null): array
    {
        $url = config('services.scraperapi.api').'/structured/twitter/v2/tweets';
        $params = [
            'api_key' => $this->apiKey,
            'user_id' => $userId,
        ];

        if (! is_null($nextCursor)) {
            $params['next_cursor'] = $nextCursor;
        }

        $res = Http::get($url, $params);

        return $res->json() ?? $res->body();
    }

    /**
     * Retrieves an individual tweet information
     */
    public function tweetInfo(string $tweetId): array
    {
        $url = config('services.scraperapi.api').'/structured/twitter/v2/tweet';
        $params = [
            'api_key' => $this->apiKey,
            'tweet_id' => $tweetId,
        ];

        $res = Http::get($url, $params);

        return $res->json() ?? $res->body();
    }
}
