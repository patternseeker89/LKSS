<?php

namespace LKSS\Db\File;

use LKSS\Db\DbInterface;

interface FileDbInterface extends DbInterface
{
    public function insert(string $key, array $data): bool;
    public function update(string $key, array $newData): bool;
    public function delete(string $key): bool;
}
