<?php

namespace Diverently\IbanInfo;

use Diverently\IbanInfo\Countries\Country;
use Diverently\IbanInfo\Exceptions\IbanException;

class IbanInfo
{
    public string $iban;

    public Country $country;

    public string $bank_code;

    public string $account_number;

    public string $bic;

    public string $bank_name;

    public string $country_code;

    public function getData(string $iban)
    {
        $this->iban = self::getTrimmedIban($iban);
        $country = Country::getCountry($this->iban);
        $country->validateIban($this->iban);
        $data = (object) $country->getData($this->iban);

        $this->country = $country;
        $this->bank_code = $data->bank_code;
        $this->account_number = $data->account_number;
        $this->bic = $data->bic;
        $this->bank_name = $data->bank_name;
        $this->country_code = $data->country_code;

        return $this;
    }

    public function forIban(?string $iban = null)
    {
        if ($iban) {
            return $this->getData($iban);
        } elseif (isset($this->iban)) {
            return $this;
        } else {
            throw new IbanException('No IBAN provided');
        }

        return $this;
    }

    public function getBankCode(?string $iban = null): string
    {
        return $this->forIban($iban)->bank_code;
    }

    public function getAccountNumber(?string $iban = null): string
    {
        return $this->forIban($iban)->account_number;
    }

    public function getBic(?string $iban = null): string
    {
        return $this->forIban($iban)->bic;
    }

    public function getBankName(?string $iban = null): string
    {
        return $this->forIban($iban)->bank_name;
    }

    public function getCountryCode(?string $iban = null): string
    {
        return $this->forIban($iban)->country_code;
    }

    public static function getTrimmedIban(string $iban): string
    {
        return str_replace(' ', '', $iban);
    }
}
