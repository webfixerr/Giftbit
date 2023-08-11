<?php

namespace WFX\Giftbit\Giftbit;

use WFX\Giftbit\Client\Client;
use WFX\Giftbit\Config\Config;
use WFX\Giftbit\Exceptions\GiftbitErrors;
use WFX\Giftbit\Response\BrandResponse;
use WFX\Giftbit\Response\CancelResponse;
use WFX\Giftbit\Response\CreateBalanceResponse;
use WFX\Giftbit\Response\CreateResponse;
use WFX\Giftbit\Response\RegionResponse;

class Giftbit
{
    public const ACCEPT_HEADER = 'Accept-Encoding';
    public const CONTENT_HEADER = 'content-type';
    public const AUTHORIZATION_HEADER = 'Authorization';
    public const BRANDS_SERVICE = 'brands';
    public const REGION_SERVICE = 'regions';
    public const CREATE_GIFT_SERVICE = 'campaign';
    public const LIST_GIFT_SERVICE = 'gifts';
    public const CANCEL_GIFT_SERVICE = 'gifts';
    public const RESEND_GIFT_SERVICE = 'gifts';
    public const RETRIEVE_GIFT_SERVICE = 'gifts';
    public const GET_AVAILABLE_FUNDS_SERVICE = 'funds';
    public const ADD_FUNDS_SERVICE = 'funds';

    private $_config;


    /**
     * AWS constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->_config = $config;
    }

    /**
     * @param $region
     * @return RegionResponse
     *
     * @throws GiftbitErrors
     */
    public function getRegions($region): RegionResponse
    {
        $serviceOperation = self::REGION_SERVICE;
        $result = json_decode($this->makeRequest($serviceOperation, null, false), true);
        return new RegionResponse($result, $region);
    }

    /**
     * @param $region
     * @return BrandResponse
     *
     * @throws GiftbitErrors
     */
    public function getBrands($region): BrandResponse
    {
        $serviceOperation = self::BRANDS_SERVICE.'?region='.$region;
        $result = json_decode($this->makeRequest($serviceOperation, null, false), true);
        return new BrandResponse($result);
    }

    /**
     * @param $payload
     * @return CreateResponse
     *
     * @throws GiftbitErrors
     */
    public function createCampaign($payload): CreateResponse
    {
        $serviceOperation = self::CREATE_GIFT_SERVICE;
        $result = json_decode($this->makeRequest($serviceOperation, $payload, true), true);
        return new CreateResponse($result);
    }

    // /**
    //  * @param $amount
    //  * @param $creationId
    //  * @return CreateResponse
    //  *
    //  * @throws GiftbitErrors
    //  */
    // public function getCode($amount, $creationId = null): CreateResponse
    // {
    //     $serviceOperation = self::CREATE_GIFT_SERVICE;
    //     $payload = $this->getGiftCardPayload($amount, $creationId);
    //     $canonicalRequest = $this->getCanonicalRequest($serviceOperation, $payload);
    //     $result = json_decode($this->makeRequest($payload, $canonicalRequest, $serviceOperation), true);
    //     return new CreateResponse($result);
    // }

    // /**
    //  * @param $creationRequestId
    //  * @param $gcId
    //  * @return CancelResponse
    //  */
    // public function cancelCode($creationRequestId, $gcId): CancelResponse
    // {
    //     $serviceOperation = self::CANCEL_GIFT_SERVICE;
    //     $payload = $this->getCancelGiftCardPayload($creationRequestId, $gcId);
    //     $canonicalRequest = $this->getCanonicalRequest($serviceOperation, $payload);
    //     $result = json_decode($this->makeRequest($payload, $canonicalRequest, $serviceOperation), true);
    //     return new CancelResponse($result);
    // }

    // /**
    //  * @return CreateBalanceResponse
    //  */
    // public function getBalance(): CreateBalanceResponse
    // {
    //     $serviceOperation = self::GET_AVAILABLE_FUNDS_SERVICE;
    //     $payload = $this->getAvailableFundsPayload();
    //     $canonicalRequest = $this->getCanonicalRequest($serviceOperation, $payload);
    //     $result = json_decode($this->makeRequest($payload, $canonicalRequest, $serviceOperation), true);
    //     return new CreateBalanceResponse($result);
    // }

    /**
     * @param $serviceOperation
     * @param $payload
     * @return string
     */
    public function makeRequest($serviceOperation, $payload, $post): string
    {
        $endpoint = $this->_config->getEndpoint();
        $url = 'https://' . $endpoint . '/papi/v1/' . $serviceOperation;
        $headers = $this->buildHeaders();
        $payload = json_encode($payload);
        return (new Client())->request($url, $headers, $payload, $post);
    }

    /**
     * @param $payload
     * @param $authorizationValue
     * @param $dateTimeString
     * @param $serviceTarget
     * @return array
     */
    public function buildHeaders(): array
    {
        $ACCEPT_HEADER = self::ACCEPT_HEADER;
        $AUTHORIZATION_HEADER = self::AUTHORIZATION_HEADER;
        $authorizationValue = $this->_config->getAccessKey();
        return [
            'Content-Type: ' . $this->getContentType(),
            $AUTHORIZATION_HEADER . ': Bearer ' . $authorizationValue,
            $ACCEPT_HEADER . ': ' . $this->getAcceptEncoding()
        ];
    }


    /**
     * @param $amount
     * @param $creationId
     * @return string
     */
    public function getGiftCardPayload($amount, $creationId = null): string
    {
        $amount = trim($amount);
        $payload = [
            'creationRequestId' => $creationId ?: '',
            'value' =>
                [
                    'currencyCode' => $this->_config->getCurrency(),
                    'price_in_cents' => (float)$amount
                ]
        ];
        return json_encode($payload);
    }

    /**
     * @param $creationRequestId
     * @param $gcId
     * @return string
     */
    public function getCancelGiftCardPayload($creationRequestId, $gcId): string
    {
        $gcResponseId = trim($gcId);
        $payload = [
            'creationRequestId' => $creationRequestId,
            'gcId' => $gcResponseId
        ];
        return json_encode($payload);
    }

    /**
     * @return string
     */
    public function getAvailableFundsPayload(): string
    {
        $payload = [
        ];
        return json_encode($payload);
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return 'application/json';
    }

    /**
     * @return string
     */
    public function getAcceptEncoding(): string
    {
        return 'identity';
    }
}