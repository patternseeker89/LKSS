<?php

namespace LKSS;

use LKSS\Console\Commands\Factories\SimpleCommandFactory;
use LKSS\Console\Commands\Factories\CompoundCommandFactory;
use LKSS\Console\Console;
use LKSS\Storage\Keeper\StorageKeeper;
use LKSS\Storage\StorageTree;
use LKSS\Storage\StorageVisualizer;

class App 
{
    private Console $console;

    public function __construct()
    {
        $storage = new StorageTree(
            new StorageKeeper(),
            new StorageVisualizer(),
        );
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
