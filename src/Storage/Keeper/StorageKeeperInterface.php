<?php

namespace LKSS\Storage\Keeper;

use LKSS\Storage\Node;
use LKSS\Storage\StorageTreeInterface;

interface StorageKeeperInterface
{
    public function save(?Node $root): void;
    public function load(StorageTreeInterface $storage): ?Node;
}