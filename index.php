<?php

declare(strict_types=1);

namespace LKSS;

require_once 'vendor/autoload.php';

$storage = new StorageTree(new SvgImage());

        $storage->insertNode(null, 'My Banks','test data');
//
//        $storage->insertNode(2, 1, 'PUMB','test data 2', 10*$k, 30*$k);
//
//        $storage->insertNode(3, 1, 'Privatbank', 'test data 3', 30*$k, 30*$k);
//
//        $storage->insertNode(4, 3, 'Accounts', 'test data 4', 20*$k, 40*$k);
//
//        $storage->insertNode(41, 3, 'Deposits', 'fssdf fsf', 30*$k, 40*$k);
//
//        $storage->insertNode(5, 2, 'Cards', 'test data 5', 40*$k, 40*$k);
//
//        $storage->insertNode(6, 5, 'Internet card', 'test data 6', 30*$k, 50*$k);
//
//        $storage->insertNode(7, 5, 'Universal card', 'test data 7', 50*$k, 50*$k);
//
//        $storage->insertNode(8, 7, 'PIN code', '2341', 60*$k, 40*$k);
//
//        $storage->insertNode(10, 7, 'Old PIN code', '2341', 60*$k, 30*$k);
//        
//        $storage->insertNode(9, 2, 'Text test',
//                'Тултип, – всплывающая подсказка при наведении курсора, есть во многих программных продуктах.
//        В svg тултип реализуется с помощью парного тега <title> Текст подсказки </title>',
//                10*$k, 50*$k);

$console = new Console\Console($storage);
$app = new App($console);
$app->run();
