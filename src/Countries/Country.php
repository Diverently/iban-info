<?php

namespace Diverently\IbanInfo\Countries;

use Diverently\IbanInfo\Exceptions\BicException;
use Diverently\IbanInfo\Exceptions\IbanException;

class Country
{
    const COUNTRY_CLASSES = [
        'DE' => Germany::class,
        'CH' => Switzerland::class,
        'AT' => null,
        'LU' => null,
        // TODO Restliche Länder
    ];

    // TODO Umbenennen in country code
    public $code;

    public $bank_code_start;

    public $bank_code_length;

    public $account_number_start;

    public $account_number_length;

    public $iban_pattern;

    public $csv_path;

    public $csv_bic_index;

    public $csv_bank_name_index;

    public static function getCountry(string $iban): Country
    {
        $country_code = self::getCountryCode($iban);

        self::validateCountryCode($country_code);

        $country_class = self::getCountryClass($country_code);

        return new $country_class;
    }

    private static function getCountryCode(string $iban): string
    {
        $country_code = strtoupper(substr($iban, 0, 2));

        return $country_code;
    }

    public static function getCountryClass(string $country_code)
    {
        $country_code = strtoupper($country_code);

        return self::COUNTRY_CLASSES[$country_code];
    }

    public static function validateCountryCode(string $country_code): bool
    {
        if (! preg_match('/^[a-zA-Z]{2}$/', $country_code)) {
            throw new IbanException("Country code $country_code is invalid");
        }

        if (! array_key_exists($country_code, self::COUNTRY_CLASSES)) {
            throw new IbanException("Country code $country_code is invalid");
        }

        if (self::COUNTRY_CLASSES[$country_code] === null) {
            throw new IbanException("Country code $country_code is currently not supported");
        }

        return true;
    }

    public function getData(string $iban): array
    {
        // Only works if all ibans are built in the same way!!
        preg_match($this->iban_pattern, $iban, $ibanSubgroups);
        $ibanData = [
            'country_code' => $ibanSubgroups[1],
            'pruefziffer' => $ibanSubgroups[2],
            'bank_code' => $ibanSubgroups[3],
            'account_number' => $ibanSubgroups[4],
        ];

        $bank_code = $ibanData['bank_code'];
        $account_number = $ibanData['account_number'];

        $csv = $this->readCsv();
        $entryString = $this->findBankCodeInCsv($csv, $bank_code);
        $data = explode(',', $entryString);
        $data = array_map(function ($row) {
            return str_replace('"', '', $row);
        }, $data);

        $bic = $data[$this->csv_bic_index];
        if ($this->validateBic($bic)) {
            $ibanData['bic'] = $bic;
        }

        $ibanData['bank_name'] = $data[$this->csv_bank_name_index];

        return $ibanData;
    }

    private function readCsv(): array
    {
        $csv = file_get_contents(__DIR__.'/../'.$this->csv_path);
        $csv_array = explode(PHP_EOL, $csv);

        return $csv_array;
    }

    private function findBankCodeInCsv(array $csv_array, string $bank_code): string
    {
        $search_for = "\"{$bank_code}\"";
        $results = array_filter($csv_array, function ($row) use ($search_for) {
            return str_starts_with($row, $search_for);
        });
        $results = array_filter($results, function ($row) {
            $result_array = explode(',', $row);

            return $result_array[$this->csv_bic_index] !== '""';
        });
        $results = array_values($results);

        return $results[0];
    }

    public function validateIban(string $iban): bool
    {
        // TODO iban trimmen
        if (! preg_match($this->iban_pattern, $iban)) {
            throw new IbanException('Invalid IBAN');
        }

        return true;
    }

    public function validateBic(string $bic): bool
    {
        if (strlen($bic) !== 11 && strlen($bic) !== 8) {
            throw new BicException('BIC has to be 8 or 11 characters long');
        }

        if (! ctype_alnum($bic)) {
            throw new BicException('BIC has to be alphanumeric');
        }

        if (substr($bic, 4, 2) !== $this->code) {
            throw new BicException('BIC has to include country code');
        }

        return true;
    }
}
