<?php

use Diverently\IbanInfo\IbanInfo;

if (! function_exists('iban_info')) {
    function iban_info(?string $iban = null): IbanInfo
    {
        return (new IbanInfo)->forIban($iban);
    }
}
