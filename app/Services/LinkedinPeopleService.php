<?php

namespace App\Services;

class LinkedinPeopleService extends HttpService
{
    private $token;

    public function __construct()
    {
        parent::__construct('https://api.linkedin.com');
    }
}
