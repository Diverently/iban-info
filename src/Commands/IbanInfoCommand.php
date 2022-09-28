<?php

namespace Diverently\IbanInfo\Commands;

use Illuminate\Console\Command;

class IbanInfoCommand extends Command
{
    public $signature = 'iban-info';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
