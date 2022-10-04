<?php

namespace Diverently\IbanInfo;

class IbanInfo
{
    public string $iban;

    public string $blz;

    public string $accountNumber;

    public string $bic;

    public string $bankName;

    public string $bankCountryCode;

    public function __construct(string $iban)
    {
        $this->iban = $iban;

        $this->validateIban($iban);

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
        $this->bic = $ibanData->bic;
        $this->bankName = $ibanData->bankName;
    }

    private function getCountryCode(string $iban)
    {
        return substr($iban, 0, 2);
    }

    private function getBlz(string $iban)
    {
        return substr($iban, 4, 8);
    }

    private function getAccountNumber(string $iban)
    {
        return substr($iban, 12);
    }

    private function validateIban(string $iban)
    {
        return true;
    }
}

