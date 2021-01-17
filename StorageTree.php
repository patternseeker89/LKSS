<?php

class StorageTree
{
    private ?Node $root;
    private array $nodesKeys;

    public function __construct()
    {
        $this->root = null;
        $this->nodesKeys = [];
    }
    
    public function insertNode(int $key, ?int $parentNodeKey, string $data): void
    {
        
        $newNode = new Node($key, $data);
        
        /*if (\is_null($parentNodeKey)) {
            $this->root = $newNode;
        } else if(\is_null($this->root->getChildren())) {
            $this->root->addChild($newNode);          
        } else {
            //$parentNode = $this->getNodeByKey11($parentNodeKey);
            var_dump($parentNode);
            //$parentNode->addChild($parentNode);
        }*/
        
        if (\is_null($parentNodeKey)) {
            $this->root = $newNode;      
        } else {
            $this->root->addChild($newNode);
            $this->root->getChildren()[0]->addChild(new Node(13, '=========='));
        }
        
        $this->saveNodeKey($newNode->getKey());
    }
    
    private function saveNodeKey(int $key): void 
    {
        $this->nodesKeys[] = $key;
    }
    
    public function getNodeByKey11(int $key): ?Node 
    {
        //return new Node('data');     
        return $this->root->getNodeByKey($key, $this->root);
    }
    
    public function isEmpty(): bool
    {
        return $this->root === null;
    }
}