<?php

namespace App\Services;

class LinkedinPeopleService extends HttpService
{
    private $token;

    public function __construct()
    {
        parent::__construct('https://api.linkedin.com');
    }

    public function connections()
    {
        $params = [
            'q' => 'viewer',
            'projection' => '(elements(*(to~)),paging)',
            'start' => 0,
            'count' => 10,
        ];
        ray($params);
        $response = $this->get('/v2/connections', $params);

        // return $contacts;
    }
}
