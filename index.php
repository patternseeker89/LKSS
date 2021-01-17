<?php

require_once 'Node.php';
require_once 'StorageTree.php';

$storage = new StorageTree();
$storage->insertNode(10, 'test data');

$storage->insertNode(11, 'test data 2');

$storage->insertNode(12, 'test data 3');

var_dump($storage);
