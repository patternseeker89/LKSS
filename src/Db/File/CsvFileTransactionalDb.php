<?php

namespace LKSS\Db\File;

/**
 *
    1. открыть новый файл назначения
    2. скопируйте "first part" исходного файла в файл назначения
    3. добавление нового содержимого в файл назначения
    4. скопируйте "last part" исходного файла в файл назначения
    5. закройте оба файла
    6. удалить исходный файл
    7. переименовать новый файл
 *
    одним из трюков является файловая транзакция.
    сначала вы читаете файл до строки, в которую хотите добавить текст,
     но во время чтения сохраняете прочитанные строки в отдельном файле, например tmp.txt,
    а затем добавляете нужный текст в tmp.txt (в конце файла), после чего продолжаете чтение из исходного файла до конца.
    затем замените tmp.txt исходным файлом. в конце вы получили файл с добавленным текстом в середине :)
 */
class CsvFileTransactionalDb implements FileTransactionalDbInterface
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

    protected function find(string $key): int
    {
        return 1;
    }

    /**
     * @TODO throw exception and catch if file open error
     * MAKE transaction: commit, rollback
     */
    public function insert(array $data): void
    {
        $filePointer = fopen($this->dbFileName, 'a');
        fputcsv($filePointer, $data);
    }

    public function update(string $key, array $newData): void
    {
        $filePointer = fopen($this->dbFileName, "r");
        $tempFilePointer = fopen($this->dbTempFileName, "w");

        while ($currentData = fgetcsv($filePointer)) {
            if ($currentData[1] == $key) {
                fputcsv($tempFilePointer, $newData);
            } else {
                fputcsv($tempFilePointer, $currentData);
            }
        }

        fclose($filePointer);
        fclose($tempFilePointer);

        unlink($this->dbFileName);
        rename($this->dbTempFileName, $this->dbFileName);
    }

    public function delete(): void
    {

    }

    protected function saveNodesListIntoFile(array $data): void
    {
        $filePointer = fopen($this->dbFileName, 'w');
        fputcsv($filePointer, $data);
    }
}