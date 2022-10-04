<?php

use Diverently\IbanInfo\IbanInfo;
use Diverently\IbanInfo\IbanData;

it('works', function () {
    $ibanInfo = new IbanInfo('DE123923849283498');
    // $ibanData = new IbanData('DE', '20050550');
    // $csv = $ibanData->readCsv();
    // dd($ibanData);
    dd($ibanInfo);
});
