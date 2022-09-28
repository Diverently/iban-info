<?php

namespace Diverently\IbanInfo;

class IbanData
{
    public string $bic;
    public string $bankName;
    public string $bankCity;
    public string $bankCountryName;
    public string $bankCountryCode;

    public function __construct(string $countryCode, string $blz)
    {
        // TODO: CSV auslesen
        $csv = $this->readCsv();
        $csv->bic;
        $csv->bankName;
        $csv->bankCity;
        $csv->bankCountryName;
        $csv->bankCountryCode;
    }

    private function readCsv()
    {
        // $csv = file_get_contents(__DIR__ . '/data/iban.csv');
        $rows = [
            [
                'GENODEF1M05',
                'Volksbank Mittelhessen eG',
                'Marburg',
                'Deutschland',
                'DE',
            ],
        ];

        $csv = [
            'bic' => '123123121',
            'bankName' => 'Bank Name',
            'bankCity' => 'Bank City',
            'bankCountryName' => 'Bank Country Name',
            'bankCountryCode' => 'Bank Country Code',
        ];

        return (object) $csv;
    }
}
