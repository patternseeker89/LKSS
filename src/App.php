<?php

namespace LKSS;

use LKSS\Console\CommandFactory;
use LKSS\Console\Console;

class App 
{
    private Console $console;

    public function __construct()
    {
        $storage = new StorageTree(new SvgImage());
        $consoleFactory = new CommandFactory($storage);

        $console = new Console($consoleFactory);

        $this->console = $console;
    }

    public function run(): void
    {
        $this->console->bash();
    }
}
