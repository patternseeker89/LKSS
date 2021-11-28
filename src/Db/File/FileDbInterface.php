<?php

namespace LKSS\Db\File;

use LKSS\Db\DbInterface;

interface FileDbInterface extends DbInterface
{
    public function insert(array $data): void;
    public function update(string $key, array $newData): void;
    public function delete(): void;
}
