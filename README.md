# Giftbit

Giftbit is Laravel package for Giftbit to send Gift Cards. Integration for Giftbit API. Read more at [https://www.giftbit.com/api-documentation](https://www.giftbit.com/api-documentation)

This package will give you a simplest APIs to Create Giftbit Gift Cards based on region.


## Installation

You can install this package via Composer.

``` bash
$ composer require wfx/giftbit
```

Set the following Environment Variable in `.env` file.
```bash
GIFTBIT_ENDPOINT=[api-testbed.giftbit.com/papi/v1](https://api-testbed.giftbit.com/papi/v1)
GIFTBIT_CURRENCY=CAD
GIFTBIT_DEBUG=true/false
GIFTBIT_ACCESS_KEY=GIFTBIT_ACCESS_KEY
```

The package will register itself automatically.
Optionally publish config file of package
 ```bash
$ php artisan vendor:publish --provider="wfx\Giftbit\GiftbitServiceProvider"
```
## Usage
To get particular region from the regions list
```php
$giftbitRegion = Giftbit::make()->getRegions('Canada');
```
To get brands based on region from the brands list
```php
$giftbitBrands = Giftbit::make()->getBrands($giftbitRegion);
```
To Create Giftbit Gift Card
```php
$giftbit = Giftbit::make()->createCampaign($value);
```

## Available Methods

To change client configuration dynamic. If you pass only `$key` or other parameter will takes value from default config.
```php
$giftbit = Giftbit::make($key, $endpoint, $currency)->createCampaign($value);
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## Security

If you discover any security related issues, please email varun@webfixerr.com instead of using the issue tracker.

## Credits

- [Webfixerr][link-author]

## License

MIT. Please see the [license file](LICENSE) for more information.

[link-author]: https://github.com/webfixerr
