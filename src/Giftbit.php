<?php

namespace WFX\Giftbit;

use WFX\Giftbit\Giftbit\Giftbit as BaseGiftbit;
use WFX\Giftbit\Config\Config;
use WFX\Giftbit\Exceptions\GiftbitErrors;

class Giftbit
{

    private $_config;

    /**
     * Giftbit constructor.
     *
     * @param null $key
     * @param null $endpoint
     * @param null $currency
     */
    public function __construct($key = null, $endpoint = null, $currency = null)
    {
        $this->_config = new Config($key, $endpoint, $currency);
    }

    /**
     * @return Response\RegionResponse
     *
     * @throws GiftbitErrors
     */
    public function getRegions($region): Response\RegionResponse
    {
        return (new BaseGiftbit($this->_config))->getRegions($region);
    }

    /**
     * @return Response\BrandResponse
     *
     * @throws GiftbitErrors
     */
    public function getBrands($region): Response\BrandResponse
    {
        return (new BaseGiftbit($this->_config))->getBrands($region);
    }

    /**
     * @return Response\CreateResponse
     *
     * @throws GiftbitErrors
     */
    public function createCampaign($payload): Response\CreateResponse
    {
        return (new BaseGiftbit($this->_config))->createCampaign($payload);
    }

    // /**
    //  * @param Float $value
    //  * @param string $creationRequestId
    //  * @return Response\CreateResponse
    //  *
    //  * @throws GiftbitErrors
    //  */
    // public function buyGiftCard(Float $value, string $creationRequestId = null): Response\CreateResponse
    // {
    //     return (new BaseGiftbit($this->_config))->getCode($value, $creationRequestId);
    // }


    // /**
    //  * @param string $creationRequestId
    //  * @param string $gcId
    //  * @return Response\CancelResponse
    //  */
    // public function cancelGiftCard(string $creationRequestId, string $gcId): Response\CancelResponse
    // {
    //     return (new BaseGiftbit($this->_config))->cancelCode($creationRequestId, $gcId);
    // }

    // /**
    //  * @return Response\CreateBalanceResponse
    //  *
    //  * @throws GiftbitErrors
    //  */
    // public function getAvailableFunds(): Response\CreateBalanceResponse
    // {
    //     return (new BaseGiftbit($this->_config))->getBalance();
    // }

    /**
     * AmazonGiftCode make own client.
     *
     * @param null $key
     * @param null $endpoint
     * @param null $currency
     * @return Giftbit
     */
    public static function make($key = null, $endpoint = null, $currency = null): Giftbit
    {
        return new static($key, $endpoint, $currency);
    }

}