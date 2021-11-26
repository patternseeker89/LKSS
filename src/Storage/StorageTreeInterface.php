<?php

namespace LKSS\Storage;

/**
 *
 * @author porfirovskiy
 */
interface StorageTreeInterface
{
    public function insertNode(?string $parentKey, string $name, string $data): void;
    public function deleteNode(string $key): void;
}
