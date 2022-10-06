<?php

namespace Diverently\IbanInfo;

use Diverently\IbanInfo\Exceptions\IbanException;

// use Exception;

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

    public string $blz;

    public string $accountNumber;

    public string $bic;

    public string $bankName;

    public string $bankCountryCode;

    public function __construct(string $iban)
    {
        $this->validateIban($iban);

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

        if (! preg_match('/^[a-zA-Z]{2}$/', $countryCode)) {
            throw new IbanException('Invalid country code');
        }

        if (! array_key_exists($countryCode, self::COUNTRY_CODES)) {
            throw new IbanException('Unrecognized country code');
        }

        return $countryCode;
    }

    private function getBlz(string $iban)
    {
        return substr(
            $iban,
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['BLZ']['START'],
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['BLZ']['LENGTH']
        );
    }

    private function getAccountNumber(string $iban)
    {
        return substr(
            $iban,
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['KTO']['START'],
            self::COUNTRY_CODES[$this->getCountryCode($iban)]['KTO']['LENGTH']
        );
    }

    private function validateIban(string $iban): bool
    {
        $country_code = $this->getCountryCode($iban);
        $regex = self::COUNTRY_CODES[$country_code]['PATTERN'];

        if (preg_match($regex, $iban)) {
            return true;
        }

        throw new IbanException('Invalid IBAN');
    }

    private function validateBic(string $bic): bool
    {
        return strlen($bic) === 11;
    }
}
