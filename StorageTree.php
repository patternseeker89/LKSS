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
    
    public function insertNode(int $parentNodeKey, string $data): void
    {
        
        $newNode = new Node($data);
        
        if (\is_null($this->root)) {
            $this->root = $newNode;
        } else if(\is_null($this->root->getChildren())) {
            $this->root->addChild($newNode);          
        } else {
            $parentNode = $this->getNodeByKey($parentNodeKey);
            $parentNode->addChild($parentNode);
        }
        
        $this->saveNodeKey($newNode->getKey());
    }
    
    private function saveNodeKey(int $key): void 
    {
        $this->nodesKeys[] = $key;
    }
    
    private function getNodeByKey(int $key): Node 
    {
        return new Node('data');     
    }
    
    private function getNodeByKey1(int $key): Node 
    {
        return new Node('data');     
    }
    
    public function isEmpty(): bool
    {
        return $this->root === null;
    }
}