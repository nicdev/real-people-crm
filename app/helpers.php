<?php

if (! function_exists('gravatar')) {
    function gravatar($email)
    {
        $url = 'https://www.gravatar.com/avatar/';

        return $url.hash('sha256', strtolower(trim($email)));
    }
}

if (! function_exists('formatPersonLinkedInUrl')) {
    function formatPersonLinkedInUrl($url)
    {
        if (str_contains($url, 'https://linkedin.com')) {
            return $url;
        }

        return 'https://www.linkedin.com/in/'.$url;
    }
}

if (! function_exists('formatPersonLinkedInUrl')) {
    function formatPersonLinkedInUrl($url)
    {
        if (str_contains($url, 'https://linkedin.com')) {
            return $url;
        }

        return 'https://www.linkedin.com/company/'.$url;
    }
}

if (! function_exists('formatTwitterUrl')) {
    function formatTwitterUrl($url)
    {
        if (str_contains($url, 'https://twitter.com' || str_contains($url, 'https://x.com'))) {
            return $url;
        }

        return 'https://x.com/'.$url;
    }
}

if (! function_exists('formatWebsiteUrl')) {
    function formatWebsiteUrl($url)
    {
        if (str_contains($url, 'https://') || str_contains($url, 'http://')) {
            return $url;
        }

        return 'https://'.$url;
    }
}
