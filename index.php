<?php

//declare(strict_types=1);

require_once 'vendor/autoload.php';


$storage = new LKSS\StorageTree();

$k = 10;

$storage->insertNode(1, null, 'My Banks','test data', 20*$k, 20*$k);

$storage->insertNode(2, 1, 'PUMB','test data 2', 10*$k, 30*$k);

$storage->insertNode(3, 1, 'Privatbank', 'test data 3', 30*$k, 30*$k);

$storage->insertNode(4, 3, 'Accounts', 'test data 4', 20*$k, 40*$k);

$storage->insertNode(41, 3, 'Deposits', 'fssdf fsf', 30*$k, 40*$k);

$storage->insertNode(5, 3, 'Cards', 'test data 5', 40*$k, 40*$k);

$storage->insertNode(6, 5, 'Internet card', 'test data 6', 30*$k, 50*$k);

$storage->insertNode(7, 5, 'Universal card', 'test data 7', 50*$k, 50*$k);

$storage->insertNode(8, 7, 'PIN code', '2341', 60*$k, 40*$k);

$storage->insertNode(10, 7, 'Old PIN code', '2341', 60*$k, 30*$k);

$storage->insertNode(9, 2, 'Text test',
        'Тултип, – всплывающая подсказка при наведении курсора, есть во многих программных продуктах.
В svg тултип реализуется с помощью парного тега <title> Текст подсказки </title>',
        10*$k, 50*$k);


/*$storage->insertNode(8, 6, 'test data 8', 1*$k, 60*$k);

$storage->insertNode(9, 6, 'test data 9', 20*$k, 60*$k);

$storage->insertNode(10, 9, 'test data 10', 30*$k, 70*$k);

$storage->insertNode(11, 2, 'test data 11', 1*$k, 40*$k);

$storage->insertNode(12, 2, 'test data 12', 15*$k, 40*$k);*/

//$storage->insertNode(14, 10, 'test data 14', 20*$k, 80*$k);
//$storage->insertNode(150, 15, 'test data 15', 80*$k, 100*$k);

//var_dump($storage);

//$storage->saveTreeIntoFile();

$storage->generateHtmlPage();

////var_dump($storage->moveNode(91, 15));
//var_dump($storage);
//var_dump($storage->getNodeByKey11(4));

//$storage->printTree($storage->getRoot());
