<?php

use Diverently\IbanInfo\Countries;

// config for Diverently/IbanInfo
return [
    // possible values: 'DE', 'CH', 'LU'
    // 'search_in_countries' => ['DE'],
    'throw_exceptions' => false,
    'source' => 'csv',
    'country_classes' => [
        'DE' => Countries\Germany::class,
        'CH' => Countries\Switzerland::class,
        'AT' => Countries\Austria::class,
        'LU' => Countries\Luxembourg::class,
    ],
];
