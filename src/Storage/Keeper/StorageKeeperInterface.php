<?php

namespace LKSS\Storage\Keeper;

use LKSS\Storage\Node;

interface StorageKeeperInterface
{
    public function save(?Node $root): void;
    public function load(): ?Node;
}