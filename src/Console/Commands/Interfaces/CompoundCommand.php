<?php

namespace LKSS\Console\Commands\Interfaces;

interface CompoundCommand extends Command
{
    public const INSERT_NODE = 'insert node';
    public const UPDATE_NODE = 'update node';
    public const SHOW_NODE = 'show node';
    public const DELETE_NODE = 'delete node';
    public const MOVE_NODE = 'move node';
    public const RENAME_NODE = 'rename node';
    public const CLONE_NODE = 'clone node';

    public function execute(string $command): void;
}
