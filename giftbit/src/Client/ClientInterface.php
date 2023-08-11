<?php

namespace WFX\Giftbit\Client;


interface ClientInterface
{
    /**
     * @param string $url The URL being requested, including domain and protocol
     * @param array $headers Headers to be used in the request
     * @param array $params Can be nested for arrays and hashes
     * @param array $post checking if the request is post or get
     *
     *
     * @return String
     */

    public function request($url, $headers, $params, $post): string;
}