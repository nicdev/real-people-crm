<?php

if (! function_exists('gravatar')) {
    function gravatar($email)
    {
        $url = 'https://www.gravatar.com/avatar/';

        return $url.hash('sha256', strtolower(trim($email)));
    }
}
