<?php

require_once 'Node.php';
require_once 'StorageTree.php';

$storage = new StorageTree();
$storage->insertNode(1, null,'test data');

$storage->insertNode(2, 1, 'test data 2');

$storage->insertNode(3, 1, 'test data 3');


//var_dump($storage);
var_dump($storage->getNodeByKey11(13));
