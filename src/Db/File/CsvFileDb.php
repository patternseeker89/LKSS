<?php

namespace LKSS\Db\File;

class CsvFileDb implements FileDbInterface
{
    private CsvFileTransactionEngine $transactionEngine;

    public function __construct()
    {
        $this->transactionEngine = new CsvFileTransactionEngine();
    }

    protected function get(string $key): int
    {
        return 1;
    }

    /**
     * @TODO throw exception and catch if file open error
     * MAKE transaction: commit, rollback
     */
    public function insert(array $data): void
    {
        $this->transactionEngine->makeTransaction('', $data, Operation::INSERT);
    }

    public function insertIntoEnd(array $data): void
    {
//        $filePointer = fopen($this->dbFileName, 'a');
//        fputcsv($filePointer, $data);
    }

    public function update(string $key, array $newData): void
    {
        $this->transactionEngine->makeTransaction($key, $newData, Operation::UPDATE);
    }

    public function delete(): void
    {

    }
}