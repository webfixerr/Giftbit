<?php
namespace WFX\Giftbit\Config;


interface ConfigInterface
{
    /**
     * @return String
     */
    public function getEndpoint(): string;

    /**
     * @param $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint): ConfigInterface;

    /**
     * @return String
     */
    public function getAccessKey(): string;

    /**
     * @param $key
     * @return $this
     */
    public function setAccessKey($key): ConfigInterface;

    /**
     * @return String
     */
    public function getCurrency(): string;

    /**
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency): ConfigInterface;
}