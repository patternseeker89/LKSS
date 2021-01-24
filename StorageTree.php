<?php

class StorageTree
{
    private ?Node $root;
    private array $nodesKeys;
    private Visualizer $visualizer;
    private Storage $storage;

    public function __construct()
    {
        $this->root = null;
        $this->nodesKeys = [];
    }
    
    public function insertNode(int $key, ?int $parentNodeKey, string $data): void
    {
        if ($this->isUniqueKey($key)) {
            $newNode = new Node($key, $data);

            if (\is_null($parentNodeKey)) {
                $this->root = $newNode;        
            } else {
                $parentNode = $this->getNodeByKey($parentNodeKey);
                $newNode->setParent($parentNode);
                $parentNode->addChild($newNode);
            }

            $this->saveNodeKey($newNode->getKey());
        }
        else {
            echo 'Error: key is not unique!';
        }
    }
    
    public function deleteNode(int $nodeKey): void
    {
        $node = $this->getNodeByKey($nodeKey);

        if (!\is_null($node)) {
            $parent = $node->getParent();
            if (\is_null($parent)) {
                unset($this->root);
            } else {
                $parent->deleteChild($nodeKey);
            }
        }
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
    
    public function getPath(int $startNodeKey, int $endNodeKey): void
    {
        
    }
    
    public function getNodesNumber(): int
    {
        return \count($this->$nodesKeys);
    }
    
    public function loadTree(): bool
    {
        
    }
    
    public function saveTree(): bool
    {
        
    }
    
    private function saveNodeKey(int $key): void 
    {
        $this->nodesKeys[] = $key;
    }

    private function isUniqueKey(int $key): bool 
    {
        return !in_array($key, $this->nodesKeys);
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

    public  function getNodesKeys(): array
    {
        return $this->nodesKeys;
    }
}
