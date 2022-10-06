<?php

namespace Diverently\IbanInfo;

use Diverently\IbanInfo\Countries\Country;
use Diverently\IbanInfo\Countries\Germany;
use Diverently\IbanInfo\Exceptions\IbanException;

class IbanInfo
{
    public Country $country;

    public string $blz;

    public string $account_number;

    public string $bic;

    public string $bank;

    public string $country_code;

    public function __construct(string $iban)
    {
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
}
