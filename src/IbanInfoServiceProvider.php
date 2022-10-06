<?php

namespace Diverently\IbanInfo;

use Diverently\IbanInfo\Commands\IbanInfoCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class IbanInfoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('iban-info')
            ->hasConfigFile();
    }
}
