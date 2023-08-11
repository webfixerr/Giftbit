<?php

namespace WFX\Giftbit\Client;


use Illuminate\Http\JsonResponse;
use RuntimeException;
use WFX\Giftbit\Client\ClientInterface;
use WFX\Giftbit\Exceptions\GiftbitErrors;

class Client implements ClientInterface
{

    /**
     *
     * @param string $url The URL being requested, including domain and protocol
     * @param array $headers Headers to be used in the request
     * @param array $params Can be nested for arrays and hashes
     *
     *
     * @return String
     */
    public function request($url, $headers, $params, $post = true): string
    {
        $handle = curl_init($url);
        if($post) {
            curl_setopt($handle, CURLOPT_POST, $post);
        }
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        if($post) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($handle);

        if ($result === false) {
            $err = curl_errno($handle);
            $message = curl_error($handle);
            $this->handleCurlError($url, $err, $message);
        }

        if (curl_getinfo($handle, CURLINFO_HTTP_CODE) !== JsonResponse::HTTP_OK) {
            $err = curl_errno($handle);
            $message = json_decode($result)->message;
            throw GiftbitErrors::getError($message, $err);
        }
        return $result;

    }

    private function handleCurlError($url, $errno, $message): void
    {
        switch ($errno) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to Giftbit ($url).  Please check your "
                    . 'internet connection and try again.';
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = 'Could not verify SSL certificate.  Please make sure '
                    . 'that your network is not intercepting certificates.  '
                    . "(Try going to $url in your browser.)  "
                    . 'If this problem persists,';
                break;
            case 0:
            default:
                $msg = 'Unexpected error communicating with Giftbit. ' . $message;
        }

        throw new RuntimeException($msg);
    }
}