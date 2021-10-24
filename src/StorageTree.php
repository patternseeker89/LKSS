<?php

namespace LKSS;

class StorageTree
{
//    private ?Node $root;
    private $root;
    private array $nodesKeys;
    private Visualizer $visualizer;
    private Storage $storage;
    private $nodesList = [];
    
    private SvgImage $svgImage;

    public function __construct(SvgImage $svgImage)
    {
        $this->svgImage = $svgImage;
        
        $this->root = $this->loadTreeFromFile();
        $this->nodesKeys = [];
    }
    
    public function __destruct()
    {
        $this->saveTreeIntoFile();
    }
    
    public function insertNode(int $key, ?int $parentNodeKey, string $name, string $data, int $x, int $y): void
    {
        if ($this->isUniqueKey($key)) {
            $newNode = new Node($key, $name, $data, $x, $y);

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
    
    public function updateNode(int $key, string $data): void
    {
        
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

    private function getAllNodes(Node $parentNode): array
    {
        if ($parentNode->haveChildren()) {
            $this->nodesList = array_merge($this->nodesList, $parentNode->getChildren());
  
            foreach ($parentNode->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $this->getAllNodes($childNode);
                } else {
                    echo  "++++++++\n";
                }
            }          
        }

        return $this->nodesList;
    }

    public function getAllNodesWithBranches(?Node $parentNode): array
    {
        if (!is_null($parentNode)) {
            if ($parentNode->haveChildren()) {
                $this->nodesList[] = [
                    'nodes' => $parentNode->getChildren(),
                    'parentCoordinates' => [$parentNode->getX(), $parentNode->getY()]
                ];

                foreach ($parentNode->getChildren() as $childNode) {
                    if (!\is_null($childNode->getChildren())) {
                        $this->getAllNodesWithBranches($childNode);
                    }
                }          
            }
        }

        return $this->nodesList;
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
            return $this->findNodeInTree($key, $this->root);
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
    
    public function findNodeInChildrenByKey(int $key, Node $parentNode): ?Node 
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
    public function findNodeInTree(int $key, Node $parentNode): ?Node
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
                echo '--- key: ' . $neededNode->getKey() . ', data: "' . $neededNode->getData() . '" ---';
                echo "\n";
                return $neededNode;
            }            
        }
        
        return null;
    }
}
