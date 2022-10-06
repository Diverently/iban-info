<?php

use Diverently\IbanInfo\IbanInfo;

test('get bank code for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $bank_code = IbanInfo::getBankCode($iban);

    expect($bank_code)->toBe('37040044');
});
