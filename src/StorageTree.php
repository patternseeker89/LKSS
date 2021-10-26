<?php

namespace LKSS;

class StorageTree
{
    private $root;

    public function __construct()
    {
        $this->root = $this->loadTreeFromFile();
    }
    
    public function __destruct()
    {
        $this->saveTreeIntoFile();
    }

    public function insertNode(?string $parentKey, string $name, string $data): void
    {
        $newNode = new Node($name, $data);

        if (\is_null($parentKey)) {
            $this->root = $newNode;
        } else {
            $parentNode = $this->getNodeByKey($parentKey);
            if (!is_null($parentNode)) {
                $newNode->setParent($parentNode);
                $parentNode->addChild($newNode);
            } else {
                echo "Error: parent key is wrong!\n";
            }
        }
    }

    public function deleteNode(string $key): void
    {
        $node = $this->getNodeByKey($key);

        if (!\is_null($node)) {
            $parent = $node->getParent();
            if (\is_null($parent)) {
                unset($this->root);
            } else {
                $parent->deleteChild($key);
            }
        }
    }

    public function moveNode(int $nodeKey, ?int $targetNodeKey): void
    {
        $node = $this->getNodeByKey($nodeKey);
        $targetNode = $this->getNodeByKey($targetNodeKey);

        $this->deleteNode($nodeKey);

        if (!\is_null($node)) {
            $node->setParent($targetNode);
            $targetNode->addChild($node);
        }
    }

    public function cloneNode(int $key, ?int $targetNodeKey): void
    {
        
    }
    
    public function cloneNodeWithoutChildren(int $key, ?int $targetNodeKey): void
    {
        
    }

    public function updateNode(string $key, string $data): void
    {
        $node = $this->getNodeByKey($key);

        if (!\is_null($node)) {
            $node->setData($data);
        } else {
            echo "Node does not exist for this key!\n";
        }
    }

    public function getRoot(): ?Node
    {
        return $this->root;
    }

    public function printTree(Node $parentNode, string $separator): void
    {
        $separator = $separator . "----";
        echo $separator . "#" . $parentNode->getKey() . " " . $parentNode->getName()
            . "\n";
        if ($parentNode->haveChildren()) {
            foreach ($parentNode->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $this->printTree($childNode, $separator);
                } else {
                    $separator = $separator . "----";
                    echo $separator . "#" . $childNode->getKey() . " " . $childNode->getName()
                        . "\n";
                    $separator = substr($separator, 0, strlen($separator) -4);
                }
            }
        }
    }

    public function saveTreeIntoFile(): void
    {
        $serializedTree = serialize($this->root);

        file_put_contents('data/tree.data', $serializedTree);
    }

    private function loadTreeFromFile()
    {
        if (file_exists('data/tree.data')) {
            return unserialize(file_get_contents('data/tree.data'));
        } else {
            return null;
        }
    }
    
    public function getPath(int $startNodeKey, int $endNodeKey): void
    {
        
    }
    
    public function loadTree(): bool
    {
        
    }
    
    public function saveTree(): bool
    {
        
    }
    
    public function getNodeByKey(string $key): ?Node
    {
        if ($this->root->getKey() === $key) {    
            return $this->root;
        } else {
            return $this->findNodeInTree($key, $this->root);
        }
    }
    
    public function isEmpty(): bool
    {
        return $this->root === null;
    }
    
    public function findNodeInChildrenByKey(string $key, Node $parentNode): ?Node 
    {
        foreach ($parentNode->getChildren() as $child) {
            if ($child->getKey() === $key) {
                return $child;
            }
        }
        
        return null;
    }
    
    /**
     * Breadth-first search (BFS) used, my realization
     */
    public function findNodeInTree(string $key, Node $parentNode): ?Node
    {
        if ($parentNode->haveChildren()) {
            $neededNode = $this->findNodeInChildrenByKey($key, $parentNode);
            if (\is_null($neededNode)) {
                foreach ($parentNode->getChildren() as $childNode) {
                    $neededNode = $this->findNodeInTree($key, $childNode);
                    if (!\is_null($neededNode)) {
                        return $neededNode;
                    }
                }
            } else {
                return $neededNode;
            }            
        }
        
        return null;
    }
}
