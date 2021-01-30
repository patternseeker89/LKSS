<?php

require_once 'Node.php';
require_once 'StorageTree.php';

$storage = new StorageTree();

$k = 10;

$storage->insertNode(1, null,'test data', 20*$k, 20*$k);

$storage->insertNode(2, 1, 'test data 2', 10*$k, 30*$k);

$storage->insertNode(3, 1, 'test data 3', 30*$k, 30*$k);

$storage->insertNode(4, 3, 'test data 4', 20*$k, 40*$k);

$storage->insertNode(5, 3, 'test data 5', 40*$k, 40*$k);

$storage->insertNode(6, 4, 'test data 6', 10*$k, 50*$k);

$storage->insertNode(7, 4, 'test data 7', 30*$k, 50*$k);

$storage->insertNode(8, 6, 'test data 8', 1*$k, 60*$k);

$storage->insertNode(9, 6, 'test data 9', 20*$k, 60*$k);

$storage->insertNode(10, 9, 'test data 10', 30*$k, 70*$k);

$storage->insertNode(11, 2, 'test data 11', 1*$k, 40*$k);

$storage->insertNode(12, 2, 'test data 12', 15*$k, 40*$k);

//$storage->insertNode(12, 2, 'test data 12');

//var_dump($storage);

$storage->createSvgImg();

////var_dump($storage->moveNode(91, 15));
//var_dump($storage);
//var_dump($storage->getNodeByKey11(4));

//$storage->printTree($storage->getRoot());
