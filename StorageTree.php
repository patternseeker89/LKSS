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
        
        if (\is_null($parentNodeKey)) {
            $this->root = $newNode;        
        } else {
            $parentNode = $this->getNodeByKey11($parentNodeKey);
            $parentNode->addChild($newNode);
        }
        
        /*if (\is_null($parentNodeKey)) {
            $this->root = $newNode;      
        } else {
            $this->root->addChild($newNode);
            $this->root->getChildren()[0]->addChild(new Node(13, '=========='));
        }*/
        
        $this->saveNodeKey($newNode->getKey());
    }
    
    public function deleteNode(int $key): void
    {
        
    }
    
    public function moveNode(int $key, ?int $parentNodeKey, string $data): void
    {
        
    }
    
    public function updateNode(int $key, string $data): void
    {
        
    }
    
    private function saveNodeKey(int $key): void 
    {
        $this->nodesKeys[] = $key;
    }
    
    public function getNodeByKey11(int $key): ?Node 
    {
        if ($this->root->getKey() === $key) {    
            return $this->root;
        } else {
            return $this->root->getNodeByKey($key, $this->root);
        }
        //return $this->root->getNodeByKey($key, $this->root);
    }
    
    public function isEmpty(): bool
    {
        return $this->root === null;
    }
}
