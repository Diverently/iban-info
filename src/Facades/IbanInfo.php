<?php

namespace Diverently\IbanInfo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Diverently\IbanInfo\IbanInfo
 */
class IbanInfo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Diverently\IbanInfo\IbanInfo::class;
    }
}
