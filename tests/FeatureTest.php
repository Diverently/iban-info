<?php

use Diverently\IbanInfo\Exceptions\IbanException;
use Diverently\IbanInfo\Facades\IbanInfo;

test('facade works', function () {
    $iban = 'DE89370400440532013000';
    $data = IbanInfo::getData($iban);
    $this->assertEquals('DE', $data->country_code);
});

test('a valid german iban works', function () {
    $iban = 'DE13200505502222222222';
    $info = IbanInfo::getData($iban);
    $this->assertEquals($info->bank_code, '20050550');
    $this->assertEquals($info->account_number, '2222222222');
    $this->assertEquals($info->bic, 'HASPDEHHXXX');
    $this->assertEquals($info->bank_name, 'Hamburger Sparkasse');
    $this->assertEquals($info->country_code, 'DE');
});

test('a valid swiss iban works', function () {
    $iban = 'CH1310000123451234512';
    $info = IbanInfo::getData($iban);
    $this->assertEquals($info->bank_code, '10000');
    $this->assertEquals($info->account_number, '123451234512');
    $this->assertEquals($info->bic, 'BERNCHBEXXX');
    $this->assertEquals($info->bank_name, 'Schweizer Bank');
    $this->assertEquals($info->country_code, 'CH');
});

test('a short iban throws an exception', function () {
    $invalid_iban = 'DE13200505501315461';
    $this->expectException(IbanException::class);
    $info = IbanInfo::getData($invalid_iban);
});

test('an unrecognized country code throws an exception', function () {
    $invalid_iban = 'DF13200505501315461903';
    $info = IbanInfo::getData($invalid_iban);
})->throws(IbanException::class, 'Country code DF is invalid');

test('an iban with invalid country code throws an exception', function () {
    $invalid_iban = 'D132005055013154619039';
    $info = IbanInfo::getData($invalid_iban);
})->throws(IbanException::class, 'Country code D1 is invalid');

test('an iban with unsupported country code throws an exception', function () {
    $invalid_iban = 'AT13200505502222222222';
    $info = IbanInfo::getData($invalid_iban);
})->throws(IbanException::class, 'Country code AT is currently not supported');

test('an invalid iban throws an exception', function () {
    $invalid_iban = 'DE320050AAA13154619039';
    $info = IbanInfo::getData($invalid_iban);
})->throws(IbanException::class, 'Invalid IBAN');
