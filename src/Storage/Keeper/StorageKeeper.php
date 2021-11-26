<?php

namespace LKSS\Storage\Keeper;

use LKSS\Storage\Node;

/*
 * Save tree into file (Adjacency List)
 * https://bitworks.software/2017-10-20-storing-trees-in-rdbms.html
 */
class StorageKeeper implements StorageKeeperInterface
{
    public function save(?Node $root): void
    {
        /**
         * 1. get list of all nodes from storage
         * 2. save list into file
         */
    }

    public function load(): ?Node
    {
        /**
         * 1. load list from file
         * 2. build storage tree from this list
         */
    }
}
