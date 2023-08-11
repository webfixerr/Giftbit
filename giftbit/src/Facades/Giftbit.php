<?php

namespace WFX\Giftbit\Facades;

use Illuminate\Support\Facades\Facade;

class Giftbit extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'giftbit';
    }
}