<?php

use Diverently\IbanInfo\Exceptions\IbanException;
use Diverently\IbanInfo\IbanData;
use Diverently\IbanInfo\IbanInfo;

test('a valid iban works', function () {
    $iban = 'DE13200505502222222222';
    $info = new IbanInfo($iban);
    $this->assertInstanceOf(IbanInfo::class, $info);
    $this->assertEquals($info->blz, '20050550');
    $this->assertEquals($info->account_number, '2222222222');
    $this->assertEquals($info->bic, 'HASPDEHHXXX');
    $this->assertEquals($info->bank, 'Hamburger Sparkasse');
    $this->assertEquals($info->country_code, 'DE');
});

test('a short iban throws an exception', function () {
    $invalid_iban = 'DE13200505501315461';
    $this->expectException(IbanException::class);
    $info = new IbanInfo($invalid_iban);
});

test('an unrecognized country code throws an exception', function () {
    $invalid_iban = 'DF13200505501315461903';
    $info = new IbanInfo($invalid_iban);
})->throws(IbanException::class, 'Country code DF is invalid');

test('an iban with invalid country code throws an exception', function () {
    $invalid_iban = 'D132005055013154619039';
    $info = new IbanInfo($invalid_iban);
})->throws(IbanException::class, 'Country code D1 is invalid');

test('an iban with unsupported country code throws an exception', function () {
    $invalid_iban = 'AT13200505502222222222';
    $info = new IbanInfo($invalid_iban);
})->throws(IbanException::class, 'Country code AT is currently not supported');

test('an invalid iban throws an exception', function () {
    $invalid_iban = 'DE320050AAA13154619039';
    $info = new IbanInfo($invalid_iban);
})->throws(IbanException::class, 'Invalid IBAN');

// it('works', function () {
//     // $ibanInfo = new IbanInfo('de23200505501234512345');
//     $ibanInfo = new IbanInfo('ch2110000123451234512');
//     // $ibanData = new IbanData('DE', '20050550');
//     // $csv = $ibanData->readCsv();
//     // dd($ibanData);
//     dd($ibanInfo);
// });
