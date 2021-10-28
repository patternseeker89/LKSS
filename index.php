<?php

declare(strict_types=1);

namespace LKSS;

require_once 'vendor/autoload.php';

$storage = new StorageTree(new SvgImage());

$insertNodeCommand = new Console\Commands\InsertNodeCommand($storage);
$deleteNodeCommand = new Console\Commands\DeleteNodeCommand($storage);
$updateNodeCommand = new Console\Commands\UpdateNodeCommand($storage);
$renameNodeCommand = new Console\Commands\RenameNodeCommand($storage);
$moveNodeCommand = new Console\Commands\MoveNodeCommand($storage);
$showStorageStatusCommand = new Console\Commands\ShowStorageStatusCommand($storage);
$consoleFactory = new Console\ConsoleFactory($storage);

$console = new Console\Console(
    $insertNodeCommand,
    $deleteNodeCommand,
    $updateNodeCommand,
    $renameNodeCommand,
    $moveNodeCommand,
    $showStorageStatusCommand,
    $consoleFactory,
);

$app = new App($console);
$app->run();
