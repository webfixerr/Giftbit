<?php

namespace WFX\Giftbit\Response;


class CancelResponse
{

    /**
     * Giftbit gcId.
     *
     * @var string
     */
    protected $_id;

    /**
     * Giftbit creationRequestId
     *
     * @var string
     */
    protected $_creation_request_id;

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
    public function getCreationRequestId(): string
    {
        return $this->_creation_request_id;
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
    public function getRawJson(): string
    {
        return json_encode($this->_raw_json);
    }


    /**
     * @param $jsonResponse
     * @return CancelResponse
     */
    public function parseJsonResponse($jsonResponse): self
    {
        if (!is_array($jsonResponse)) {
            throw new \RuntimeException('Response must be a scalar value');
        }
        if (array_key_exists('gcId', $jsonResponse)) {
            $this->_id = $jsonResponse['gcId'];
        }
        if (array_key_exists('creationRequestId', $jsonResponse)) {
            $this->_creation_request_id = $jsonResponse['creationRequestId'];
        }

        return $this;

    }

}