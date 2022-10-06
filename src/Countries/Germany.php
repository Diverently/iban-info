<?php

namespace Diverently\IbanInfo\Countries;

class Germany extends Country
{
    public $code = 'DE';

    public $bank_code_start = 4;

    public $bank_code_length = 8;

    public $account_number_start = 12;

    public $account_number_length = 10;

    public $iban_pattern = "/^[dD][eE]\d{20}$/";

    public $csv_path = '/data/de.csv';

    public $csv_bic_index = 7;

    public $csv_bank_name_index = 2;
}
