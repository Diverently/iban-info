<?php

namespace Diverently\IbanInfo;

use Diverently\IbanInfo\Countries\Country;

class IbanInfo
{
    public Country $country;

    // TODO Umbenennen in bank code
    public string $blz;

    public string $account_number;

    public string $bic;

    // TODO Umbenennen in bank_name
    public string $bank;

    public string $country_code;

    public function __construct(string $iban)
    {
        $iban = self::getTrimmedIban($iban);

        // Set country class
        $this->country = Country::getCountry($iban);

        // Validate IBAN
        $this->country->validateIban($iban);

        // Get data
        $data = $this->country->getData($iban);
        $this->country_code = $data['country_code'];
        $this->blz = $data['bank_code'];
        $this->account_number = $data['account_number'];
        $this->bic = $data['bic'];
        $this->bank = $data['bank_name'];
    }

    public static function getBankCode(string $iban): string
    {
        $iban = self::getTrimmedIban($iban);
        $country = Country::getCountry($iban);
        $country->validateIban($iban);
        $data = $country->getData($iban);

        return $data['bank_code'];
    }

    private static function getTrimmedIban(string $iban): string
    {
        // TODO trimmen
        return $iban;
    }
}
