<?php

namespace Diverently\IbanInfo;

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
