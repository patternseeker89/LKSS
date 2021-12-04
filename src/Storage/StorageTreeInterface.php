<?php

namespace LKSS\Storage;

/**
 *
 * @author porfirovskiy
 */
interface StorageTreeInterface
{
    public function insertNode(?string $parentKey, ?string $key, string $name, string $data, bool $isOnlyMemory = false): void;
    public function updateNode(string $key, string $data): void;
    public function deleteNode(string $key): void;
    public function moveNode(string $nodeKey, string $targetNodeKey): void;
    public function cloneNode(string $key, string $targetNodeKey): void;
    public function renameNode(string $key, string $newName): void;
}
