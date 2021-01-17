<?php

class TreeNode {
    
    public int $id;
    public string $value;
    public TreeNode $parent;
    public array $children;
    
    public function __construct(string $value) 
    {
        $this->id = random_int(0, 100000000);
        $this->value = $value;
        $this->children = [];
    }
    
    public function addChild(string $value): TreeNode 
    {
        $childNode = new TreeNode($value);
        $childNode->parent = $this;
        $this->children[] = $childNode;
        
        return $childNode;
    }
}


/*$root = new TreeNode('root');
var_dump($root);
$node1 = $root->addChild('node1');
$node2 = $root->addChild('node2');
$node3 = $root->addChild('node3');

//$node1 = $root->addChild('node1')->addChild('node2')->addChild('node3');

var_dump($root, $node2);die();

$node21 = $node2->addChild('node21');
$node22 = $node2->addChild('node22');

var_dump($node22, $node22->parent->parent->value);

*/
//Хранение дерева в файле.