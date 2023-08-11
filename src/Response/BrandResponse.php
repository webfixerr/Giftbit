<?php

namespace WFX\Giftbit\Response;


use Illuminate\Support\Facades\Log;

class BrandResponse
{
    /**
     * Giftbit brand codes
     *
     * @var array
     */
    protected $_brand_code = [];
    /**
     * Giftbit Brand status
     *
     * @var string
     */
    protected $_status;
    /**
     * Giftbit Raw JSON
     *
     * @var string
     */
    protected $_raw_json;

    /**
     * Response constructor.
     * @param $jsonResponse
     */
    public function __construct($jsonResponse)
    {
        $this->_raw_json = $jsonResponse;
        $this->_status = TRUE;

        $this->parseJsonResponse($jsonResponse['brands']);
    }

    /**
     * @return array
     */
    public function getBrandCodes(): array
    {
        return $this->_brand_code;
    }

    /**
     * @return string
     */
    public function getRawJson(): string
    {
        return json_encode($this->_raw_json);
    }

    /**
     * @param $jsonResponse
     * @return RegionResponse
     */
    public function parseJsonResponse($jsonResponse): self
    {
        if (!is_array($jsonResponse)) {
            throw new \RuntimeException('Response must be a scalar value');
        }
        $this->_brand_code = array_column($jsonResponse, 'brand_code');

        return $this;

    }

}