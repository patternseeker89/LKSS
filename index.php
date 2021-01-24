<?php

require_once 'Node.php';
require_once 'StorageTree.php';

$storage = new StorageTree();

$storage->insertNode(1, null,'test data');

$storage->insertNode(2, 1, 'test data 2');

$storage->insertNode(3, 1, 'test data 3');

$storage->insertNode(4, 3, 'test data 4');

$storage->insertNode(5, 3, 'test data 5');

$storage->insertNode(6, 4, 'test data 6');

$storage->insertNode(7, 4, 'test data 7');

$storage->insertNode(8, 6, 'test data 8');

$storage->insertNode(9, 6, 'test data 9');

$storage->insertNode(10, 9, 'test data 10');

$storage->insertNode(11, 2, 'test data 11');

$storage->insertNode(12, 2, 'test data 12');

$storage->insertNode(12, 2, 'test data 12');

var_dump($storage);
//var_dump($storage->getNodeByKey11(4));
