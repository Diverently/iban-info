<?php

namespace Diverently\IbanInfo\Countries;

class Switzerland extends Country
{
    public $code = 'CH';

    public $bank_code_start = 4;

    public $bank_code_length = 5;

    public $account_number_start = 9;

    public $account_number_length = 12;

    public $iban_pattern = "/^[cC][hH]\d{19}$/";

    public $csv_path = '/data/ch.csv';

    public $csv_bic_index = 7;

    public $csv_bank_name_index = 2;
}
