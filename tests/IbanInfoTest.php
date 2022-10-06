<?php

use Diverently\IbanInfo\IbanData;
use Diverently\IbanInfo\IbanInfo;

it('works', function () {
    // $ibanInfo = new IbanInfo('de23200505501234512345');
    $ibanInfo = new IbanInfo('ch2110000123451234512');
    // $ibanData = new IbanData('DE', '20050550');
    // $csv = $ibanData->readCsv();
    // dd($ibanData);
    dd($ibanInfo);
});
