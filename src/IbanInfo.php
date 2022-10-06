<?php

namespace Diverently\IbanInfo;

class IbanInfo
{
    const COUNTRY_CODES = [
        'DE' => [
            'BLZ' => [
                'START' => 4,
                'LENGTH' => 8,
            ],
            'KTO' => [
                'START' => 12,
                'LENGTH' => 10,
            ],
            'PATTERN' => "/^[dD][eE]\d{20}$/",
        ],
        'CH' => [
            'BLZ' => [
                'START' => 4,
                'LENGTH' => 5,
            ],
            'KTO' => [
                'START' => 9,
                'LENGTH' => 12,
            ],
            'PATTERN' => "/^[cC][hH]\d{19}$/",
        ],
    ];

    public string $iban;

    public string $blz;

    public string $accountNumber;

    public string $bic;

    public string $bankName;

    public string $bankCountryCode;

    public function __construct(string $iban)
    {
        if ($this->validateIban($iban)) {
            $this->iban = $iban;
        }

        $this->setData($iban);

        // TODO: BLZ auslesen

        // TODO: In der CSV nachschauen, ob es eine Bank mit der BLZ gibt
        // $this->ibanData = new IbanData($validatedIban);
    }

    private function setData(string $iban)
    {
        $this->bankCountryCode = $this->getCountryCode($iban);
        $this->blz = $this->getBlz($iban);
        $this->accountNumber = $this->getAccountNumber($iban);

        $ibanData = new IbanData($this->bankCountryCode, $this->blz);
        if ($this->validateBic($ibanData->bic)) {
            $this->bic = $ibanData->bic;
        }
        $this->bankName = $ibanData->bankName;
    }

    private function getCountryCode(string $iban): string
    {
        $countryCode = strtoupper(substr($iban, 0, 2));
        if (array_key_exists($countryCode, self::COUNTRY_CODES)) {
            return $countryCode;
        }
    }

    private function getBlz(string $iban)
    {
        return substr(
            $iban,
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['BLZ']['START'],
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['BLZ']['LENGTH']);
    }

    private function getAccountNumber(string $iban)
    {
        return substr(
            $iban,
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['KTO']['START'],
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['KTO']['LENGTH']);
    }

    private function validateIban(string $iban): bool
    {
        return preg_match(
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['PATTERN'], $iban);
    }

    private function validateBic(string $bic): bool
    {
        return strlen($bic) === 11;
    }
}
