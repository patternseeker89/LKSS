<?php

namespace LKSS\Db\File;

use http\Exception;

/**
 *
 * 1. открыть новый файл назначения
    * 2. скопируйте "first part" исходного файла в файл назначения
    * 3. добавление нового содержимого в файл назначения
    * 4. скопируйте "last part" исходного файла в файл назначения
    * 5. закройте оба файла
    * 6. удалить исходный файл
    * 7. переименовать новый файл
     *
    * одним из трюков является файловая транзакция.
    * сначала вы читаете файл до строки, в которую хотите добавить текст,
    * но во время чтения сохраняете прочитанные строки в отдельном файле, например tmp.txt,
    * а затем добавляете нужный текст в tmp.txt (в конце файла), после чего продолжаете чтение из исходного файла до конца.
    * затем замените tmp.txt исходным файлом. в конце вы получили файл с добавленным текстом в середине :)
 */
class FileChangeTransactionEngine
{
    //db.csv
    private string $dbFileName = '/data/storage.csv';
    private string $dbTempFileName = '/data/temp-storage.csv';

    public function __construct()
    {
        $currentDir = getcwd();
        $this->dbFileName = $currentDir . $this->dbFileName;
        $this->dbTempFileName = $currentDir . $this->dbTempFileName;
    }

    /**
     * @throws \Exception
     */
    protected function makeFileChangeOperation(string $key, array $newData, string $operation): void
    {
        $filePointer = fopen($this->dbFileName, "r");
        if ($filePointer === false) {
            throw new \Exception('Opening origin db file error!');
        }

        $tempFilePointer = fopen($this->dbTempFileName, "w");
        if ($tempFilePointer === false) {
            throw new \Exception('Opening temp db file error!');
        }

        while ($currentData = fgetcsv($filePointer)) {
            if ($currentData[1] == $key) {
                Operation::make($tempFilePointer, $newData, $operation);
            } else {
                fputcsv($tempFilePointer, $currentData);
            }
        }

        if (!fclose($filePointer)) {
            throw new \Exception('Closing origin db file error!');
        }

        if (!fclose($tempFilePointer)) {
            throw new \Exception('Closing temp db file error!');
        }

        if (!unlink($this->dbFileName)) {
            throw new \Exception('Deleting origin db file error!');
        }

        if (!rename($this->dbTempFileName, $this->dbFileName)) {
            throw new \Exception('Renaming temp to origin db file error!');
        }
    }

    public function makeTransaction(string $key, array $newData, string $operation): bool
    {
        try {
            $this->makeFileChangeOperation($key, $newData, $operation);
            $result = true;
        } catch (\Throwable $exception) {
            $result = false;
        }

        return $result;
    }
}