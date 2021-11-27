<?php

namespace LKSS\Db\File;

interface FileTransactionalDbInterface
{
    public function insert(array $data): void;
    public function update(string $key, array $newData): void;
    public function delete(): void;
}
