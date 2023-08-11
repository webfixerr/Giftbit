<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Giftbit Endpoint
    |--------------------------------------------------------------------------
    |
    | Here you may want to specify endpoint based on you requirements. Giftbit
    | uses different endpoint for Sandbox and Production.
    |
    */

    'endpoint' => env('GIFTBIT_ENDPOINT', 'https://api-testbed.giftbit.com/papi/v1'),


    /*
    |--------------------------------------------------------------------------
    | Giftbit Access Key
    |--------------------------------------------------------------------------
    |
    | Amazon Gift Card On Demand API needs Access Key and Secret. You need to
    | specify both key and secret in order to generate gift cards.This will get
    | used to authenticate with Amazon Server Gift Card Gateway request.
    |
    */

    'key' => env('GIFTBIT_ACCESS_KEY', 'access_key'),

     /*
     |--------------------------------------------------------------------------
     | Amazon Gift Card Default Currency
     |--------------------------------------------------------------------------
     |
     | Here you need to specified a currency code for gift card value.
     | Supported currencies for gift card value are.
     | 'USD', 'EUR', 'JPY', 'CNY', 'CAD' , 'AUD'
     |
     */

    'currency' => env('GIFTBIT_CURRENCY', 'CAD'),

    'debug' => env('GIFTBIT_DEBUG', false)

];