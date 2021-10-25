<?php

namespace LKSS\Console\Commands;

interface Command 
{
    public function execute(string $command): void;
}
