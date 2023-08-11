<?php

namespace WFX\Giftbit\Exceptions;

use RuntimeException;

class GiftbitErrors extends RuntimeException
{
    /**
     * @param string $message
     * @param string $_error_code
     * @return GiftbitErrors
     */
    public static function getError(string $message, string $_error_code): self
    {
        return new static($message, $_error_code);
    }

}