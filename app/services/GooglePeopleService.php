<?php

namespace App\Services;

class GooglePeopleService extends HttpService
{
    private $token;

    public function __construct()
    {
        parent::__construct('https://people.googleapis.com');
    }
}
