<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_CALLBACK_URL'),
    ],

    'linkedin-openid' => [
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_CALLBACK_URL'),
    ],

    'scraperapi' => [
        'api_key' => env('SCRAPER_API_KEY'),
        'api' => env('SCRAPER_API', 'https://api.scraperapi.com'),
        'async' => env('SCRAPER_API_ASYNC', 'https://async.scraperapi.com'),
        'proxy_api' => null,
        'webhook_url' => env('SCRAPER_API_WEBHOOK_URL'),
        'basic_scrape_limit' => 2,
        'max_tries' => 4,
        'batch_size' => 200,
    ],
    'linkedin_rapid_api' => [
        'api_key' => env('LI_RAPID_API_KEY'),
        'host' => env('LI_RAPID_API_HOST', 'fresh-linkedin-profile-data.p.rapidapi.com'),
        'url' => env('LI_RAPID_API_URL', 'https://fresh-linkedin-profile-data.p.rapidapi.com/get-linkedin-profile'),
    ],
    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
    ],
];
