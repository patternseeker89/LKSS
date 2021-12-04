<?php

namespace LKSS\Db\File;

class CsvFileDb implements FileDbInterface
{
    private CsvFileHandler $fileHandler;

    public function __construct(CsvFileHandler $csvFileHandler)
    {
        $this->fileHandler = $csvFileHandler;
    }

    public function insert(string $key, array $data): bool
    {
        return $this->fileHandler->makeOperation($key, $data, Operation::INSERT);
    }

    public function update(string $key, array $newData): bool
    {
        return $this->fileHandler->makeOperation($key, $newData, Operation::UPDATE);
    }

    public function delete(string $key): bool
    {
        return $this->fileHandler->makeOperation($key, [], Operation::DELETE);
    }
}
