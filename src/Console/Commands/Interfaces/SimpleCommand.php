<?php

namespace LKSS\Console\Commands\Interfaces;

interface SimpleCommand extends Command
{
    public const SHOW_TREE = 'show tree';
    public const SHOW_STORAGE_STATUS = 'show storage status';
    public const EXIT = 'exit';

    public function execute(): void;
}
