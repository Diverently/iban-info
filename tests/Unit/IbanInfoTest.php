<?php

use Diverently\IbanInfo\Exceptions\IbanException;
use Diverently\IbanInfo\Facades\IbanInfo;
use Diverently\IbanInfo\IbanInfo as IbanInfoClass;

test('get bank code for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $bank_code = IbanInfo::getBankCode($iban);

    expect($bank_code)->toBe('37040044');
});

test('get account number for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $account_number = IbanInfo::getAccountNumber($iban);

    expect($account_number)->toBe('0532013000');
});

test('get bic for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $bic = IbanInfo::getBic($iban);

    expect($bic)->toBe('COBADEFFXXX');
});

test('get bank name for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $bank_name = IbanInfo::getBankName($iban);

    expect($bank_name)->toBe('Commerzbank');
});

test('get country code for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $country_code = IbanInfo::getCountryCode($iban);

    expect($country_code)->toBe('DE');
});

test('get data directly from iban info class for valid iban', function () {
    $iban = 'DE89370400440532013000';
    $ibanInfo = (new IbanInfoClass)->forIban($iban);
    $bank_code = $ibanInfo->getBankCode();

    expect($bank_code)->toBe('37040044');
});

test('get data directly from iban info without iban throws exception', function () {
    $ibanInfo = new IbanInfoClass;
    $bank_code = $ibanInfo->getBankCode();
})->throws(IbanException::class);
