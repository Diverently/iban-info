# Get BIC and bank name from IBAN

[![Latest Version on Packagist](https://img.shields.io/packagist/v/diverently/iban-info.svg?style=flat-square)](https://packagist.org/packages/diverently/iban-info)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/diverently/iban-info/run-tests?label=tests)](https://github.com/diverently/iban-info/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/diverently/iban-info/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/diverently/iban-info/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/diverently/iban-info.svg?style=flat-square)](https://packagist.org/packages/diverently/iban-info)

Get the BIC and bank name for a given IBAN. This package currently only works for german banks.

## Installation

You can install the package via composer:

```bash
composer require diverently/iban-info
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="iban-info-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$ibanInfo = new Diverently\IbanInfo();
echo $ibanInfo->echoPhrase('Hello, Diverently!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Robert Cordes](https://github.com/RobertCordes)
- [Alexander Cordes](https://github.com/PianiniHH)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
