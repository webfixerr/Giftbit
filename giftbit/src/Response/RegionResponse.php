<?php

namespace WFX\Giftbit\Response;


use Illuminate\Support\Facades\Log;

class RegionResponse
{
    /**
     * Giftbit Region id
     *
     * @var string
     */
    protected $_id;
    /**
     * Giftbit Region name
     *
     * @var string
     */
    protected $_name;
    /**
     * Giftbit Region image url
     *
     * @var string
     */
    protected $_image_url;
    /**
     * Giftbit status
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
    public function __construct($jsonResponse, $region)
    {
        $this->_raw_json = $jsonResponse;
        $this->_status = TRUE;

        $jsonResponseKey = array_search($region, array_column($jsonResponse['regions'], 'name'));
        $this->parseJsonResponse($jsonResponse['regions'][$jsonResponseKey]);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->_image_url;
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
        if (array_key_exists('id', $jsonResponse)) {
            $this->_id = $jsonResponse['id'];
        }
        if (array_key_exists('name', $jsonResponse)) {
            $this->_name = $jsonResponse['name'];
        }
        if (array_key_exists('image_url', $jsonResponse)) {
            $this->_image_url = $jsonResponse['image_url'];
        }

        return $this;

    }

}