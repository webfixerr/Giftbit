<?php

namespace WFX\Giftbit\Response;


class CreateResponse
{

    /**
     * Giftbit id.
     *
     * @var string
     */
    protected $_id;

    /**
     * Giftbit Uuid
     *
     * @var string
     */
    protected $_uuid;

    /**
     * Giftbit response
     *
     * @var string
     */
    protected $_response;

    /**
     * Giftbit status
     *
     * @var string
     */
    protected $_status;
    /**
     * Giftbit Expiration Date
     *
     * @var string
     */
    protected $_expiration_date;
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
        $this->parseJsonResponse($jsonResponse);
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
    public function getUuid(): string
    {
        return $this->_uuid;
    }


    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->_response;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->_status;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->_expiration_date;
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
     * @return CreateResponse
     */
    public function parseJsonResponse($jsonResponse): self
    {
        if (!is_array($jsonResponse)) {
            throw new \RuntimeException('Response must be a scalar value');
        }
        $jsonRes = $jsonResponse['campaign'];
        if (array_key_exists('id', $jsonRes)) {
            $this->_id = $jsonRes['id'];
        }
        if (array_key_exists('uuid', $jsonRes)) {
            $this->_uuid = $jsonRes['uuid'];
        }
        if (array_key_exists('expiry', $jsonRes)) {
            $this->_expiration_date = $jsonRes['expiry'];
        }

        return $this;

    }

}