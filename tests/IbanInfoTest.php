<?php

use Diverently\IbanInfo\IbanInfo;

it('works', function () {
    $ibanInfo = new IbanInfo('DE89370400440532013000');

    dd($ibanInfo);
});
