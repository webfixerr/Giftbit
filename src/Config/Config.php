<?php
namespace WFX\Giftbit\Config;


class Config implements ConfigInterface
{

    /**
     * The current Endpoint version.
     *
     * @var string
     */
    private $_endpoint;

    /**
     * The Giftbit Access Key.
     *
     * @var string
     */
    private $_accessKey;

    /**
     * The Giftbit Currency.
     *
     * @var string
     */
    private $_currency;


    public function __construct($key, $endpoint, $currency)
    {

        $this->setAccessKey($key ?: config('giftbit.key'));
        $this->setEndpoint($endpoint ?: config('giftbit.endpoint'));
        $this->setCurrency($currency ?: config('giftbit.currency'));
    }

    /**
     * @return String
     */
    public function getEndpoint(): string
    {
        return $this->_endpoint;
    }


    /**
     * @param $endpoint
     * @return ConfigInterface
     */
    public function setEndpoint($endpoint): ConfigInterface
    {
        $this->_endpoint = parse_url($endpoint, PHP_URL_HOST);

        return $this;
    }

    /**
     * @return String
     */
    public function getAccessKey(): string
    {
        return $this->_accessKey;
    }

    /**
     * @param String $key
     * @return ConfigInterface
     */
    public function setAccessKey($key): ConfigInterface
    {
        $this->_accessKey = $key;

        return $this;
    }

    /**
     * @return String
     */
    public function getCurrency(): string
    {
        return $this->_currency;
    }

    /**
     * @param String $currency
     * @return ConfigInterface
     */
    public function setCurrency($currency): ConfigInterface
    {
        $this->_currency = $currency;

        return $this;
    }
}