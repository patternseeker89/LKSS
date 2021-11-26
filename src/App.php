<?php

namespace LKSS;

use LKSS\Console\Commands\Factories\SimpleCommandFactory;
use LKSS\Console\Commands\Factories\CompoundCommandFactory;
use LKSS\Console\Console;
use LKSS\Storage\StorageTree;

class App 
{
    private Console $console;

    public function __construct()
    {
        $storage = new StorageTree(new SvgImage());
        $simpleCommandFactory = new SimpleCommandFactory($storage);
        $compoundCommandFactory = new CompoundCommandFactory($storage);

        $console = new Console($simpleCommandFactory, $compoundCommandFactory);

        $this->console = $console;
    }

    public function run(): void
    {
        $this->console->bash();
    }
}
