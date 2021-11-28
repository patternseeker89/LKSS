<?php

namespace LKSS\Db\File;

use LKSS\Db\TransactionalDbInterface;

interface FileTransactionalDbInterface extends TransactionalDbInterface
{
    public function insert(array $data): void;
    public function update(string $key, array $newData): void;
    public function delete(): void;
}
