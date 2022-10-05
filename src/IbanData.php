<?php

namespace Diverently\IbanInfo;

class IbanData
{
    const BIC_INDEX = 7;

    const BANK_NAME_INDEX = 2;

    public string $bic;

    public string $bankName;

    public string $bankCountryCode = '';

    public function __construct(string $countryCode, string $blz)
    {
        // TODO: CSV auslesen
        $this->bankCountryCode = strtolower($countryCode);
        $csv = $this->readCsv();
        $entryString = $this->findBlzInCsv($csv, $blz);
        $data = explode(',', $entryString);
        $data = array_map(function ($row){
            return str_replace('"', '', $row);
        }, $data);
        $bic = $data[self::BIC_INDEX];
        $this->bic = $data[self::BIC_INDEX];
        $this->bankName = $data[self::BANK_NAME_INDEX];
    }

    public function readCsv()
    {
        $csv = file_get_contents(__DIR__ . "/data/{$this->bankCountryCode}.csv");
        $csv_array = explode(PHP_EOL, $csv);

        return $csv_array;
    }
    public function findBlzInCsv(array $csv_array, string $blz)
    {
        $search_for = "\"{$blz}\"";
        $results = array_filter($csv_array, function($row) use ($search_for) {
            return str_starts_with($row, $search_for);
        });
        $results = array_filter($results, function($row){
            $result_array = explode(',', $row);
            return $result_array[self::BIC_INDEX] !== '""';
        });
        $results = array_values($results);
        // dd($results);
        return $results[0];
    }
}
