<?php

use Diverently\IbanInfo\Countries\Country;
use Diverently\IbanInfo\Countries\Germany;
use Diverently\IbanInfo\Countries\Switzerland;
use Diverently\IbanInfo\Exceptions\BicException;

test('a bic with invalid length throws an exception', function ($invalid_bic) {
    (new Country)->validateBic($invalid_bic);
})->with([
    '1234567',
    '123456789',
    '123456789012',
])->throws(BicException::class, 'BIC has to be 8 or 11 characters long');

test('a non alphanumeric bic throws an exception', function ($invalid_bic) {
    (new Country)->validateBic($invalid_bic);
})->with([
    'ABCHFJD(',
    '&ADJKSD$',
    'ASD 59AF',
])->throws(BicException::class, 'BIC has to be alphanumeric');

test('a bic missing country code throws an exception', function ($invalid, $country) {
    (new $country)->validateBic($invalid);
})->with([
    ['HASPDKHHXXX', Germany::class],
    ['HASPCUHHXXX', Switzerland::class],
])->throws(BicException::class, 'BIC has to include country code');
