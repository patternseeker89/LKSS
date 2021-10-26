<?php

declare(strict_types=1);

namespace LKSS;

require_once 'vendor/autoload.php';

$storage = new StorageTree(new SvgImage());

$insertNodeCommand = new Console\Commands\InsertNodeCommand($storage);
$showNodeCommand = new Console\Commands\ShowNodeCommand($storage);
$showTreeCommand = new Console\Commands\ShowTreeCommand($storage);
$deleteNodeCommand = new Console\Commands\DeleteNodeCommand($storage);
$updateNodeCommand = new Console\Commands\UpdateNodeCommand($storage);

$console = new Console\Console(
    $insertNodeCommand,
    $showNodeCommand,
    $showTreeCommand,
    $deleteNodeCommand,
    $updateNodeCommand,
);

$app = new App($console);
$app->run();
