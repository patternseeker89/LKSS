<?php

class StorageTree
{
    private ?Node $root;
    private array $nodesKeys;
    private visualizer $visualizer;

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
            $parentNode = $this->getNodeByKey($parentNodeKey);
            $parentNode->addChild($newNode);
        }
        
        $this->saveNodeKey($newNode->getKey());
    }
    
    public function deleteNode(int $key): void
    {
        
    }
    
    public function moveNode(int $key, ?int $targetNodeKey): void
    {
        
    }
    
    public function cloneNode(int $key, ?int $targetNodeKey): void
    {
        
    }
    
    public function cloneNodeWithoutChildren(int $key, ?int $targetNodeKey): void
    {
        
    }
    
    public function updateNode(int $key, string $data): void
    {
        
    }
    
    public function getAllNodes(): array
    {
        
    }
    
    public function printTree(): void
    {
        
    }
    
    public function getPath(int $startKey int $endKey): void
    {
        
    }
    
    public function getNodesNumber(): int
    {
        return \count($this->$nodesKeys);
    }
    
    private function saveNodeKey(int $key): void 
    {
        $this->nodesKeys[] = $key;
    }
    
    public function getNodeByKey(int $key): ?Node 
    {
        if ($this->root->getKey() === $key) {    
            return $this->root;
        } else {
            return $this->root->getNodeByKey($key, $this->root);
        }
    }
    
    public function isEmpty(): bool
    {
        return $this->root === null;
    }
}
