<?php

namespace LKSS\Console\Commands;

interface Command 
{
    public const SHOW_TREE = 'show tree';
    public const SHOW_STORAGE_STATUS = 'show storage status';
    public const EXIT = 'exit';

    public const INSERT_NODE = 'insert node';
    public const UPDATE_NODE = 'update node';
    public const SHOW_NODE = 'show node';
    public const DELETE_NODE = 'delete node';
    public const MOVE_NODE = 'move node';
    public const RENAME_NODE = 'rename node';
    public const CLONE_NODE = 'clone node';
    

    public function execute(string $command): void;
}
