<?php

namespace LKSS;

use LKSS\Console\Console;

class App 
{
    private Console $console;
    
    public function __construct(
        Console $console
    ) {
        $this->console = $console;
    }

    public function run(): void
    {
        $this->console->bash();
    }
}
