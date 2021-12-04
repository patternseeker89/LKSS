<?php

namespace LKSS;

use LKSS\Console\Commands\Factories\SimpleCommandFactory;
use LKSS\Console\Commands\Factories\CompoundCommandFactory;
use LKSS\Console\Console;
use LKSS\Db\File\CsvFileDb;
use LKSS\Db\File\CsvFileHandler;
use LKSS\Storage\Keeper\CsvStorageKeeper;
use LKSS\Storage\StorageTree;
use LKSS\Storage\StorageVisualizer;

class App
{
    private Console $console;

    public function __construct()
    {

       //(new CsvFileDb(new CsvFileHandler()))->insert(['dsd', 'key', 'name', 'data']);die();
//1f422ac1963dd8072c49,8f9c4837cb0e40b44444,HYY-KJHHHJUJH,
//        (new CsvFileDb(new CsvFileHandler()))->update(
//            '606c508dc517e404c96b',
//            ['8f9c4837cb0e40b44444', '606c508dc517e404c96b', '===NAME===', '===DATA===']
//        );die();

        $storage = new StorageTree(
            new CsvStorageKeeper(),
            new StorageVisualizer(),
            new CsvFileDb(new CsvFileHandler()),
        );
        $simpleCommandFactory = new SimpleCommandFactory($storage);
        $compoundCommandFactory = new CompoundCommandFactory($storage);

        $console = new Console($simpleCommandFactory, $compoundCommandFactory);

        $this->console = $console;
    }

    public function run(): void
    {
        $this->console->bash();
    }
}
