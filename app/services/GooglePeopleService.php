<?php

namespace App\Services;

class GooglePeopleService extends HttpService
{
    private $token;

    public function __construct()
    {
        parent::__construct('https://people.googleapis.com');
    }

    public function contacts()
    {
        ray('contacts');
        $contacts = [];
        do {
            $params = isset($response['nextPageToken']) ?
                ['personFields' => 'names,emailAddresses,photos,birthdays', 'pageSize' => 1000, 'pageToken' => $response['nextPageToken']] :
                ['personFields' => 'names,emailAddresses,photos,birthdays', 'pageSize' => 1000];
            $response = $this->get('/v1/people/me/connections', $params);
            ray($response['connections'][0], $response['connections'][1], $response['connections'][2]);
            // ray()->pause();
            $contacts = [...$contacts, ...$response['connections']];
        } while (isset($response['nextPageToken']));

        return $contacts;
    }
}
