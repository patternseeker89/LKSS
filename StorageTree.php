<?php

/**
 * Apache 2.0-license
 */
class StorageTree
{
    private ?Node $root;
    private array $nodesKeys;
    private Visualizer $visualizer;
    private Storage $storage;
    private $nodesList = [];

    public function __construct()
    {
        $this->root = null;
        $this->nodesKeys = [];
    }
    
    public function insertNode(int $key, ?int $parentNodeKey, string $data, int $x, int $y): void
    {
        if ($this->isUniqueKey($key)) {
            $newNode = new Node($key, $data, $x, $y);

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
    
    
    /*
    https://ru.wikipedia.org/wiki/SVG
    Интерактивность. На каждый отдельный элемент и на целое изображение можно повесить обработчик событий (клик, перемещение, нажатие клавиши и т.д), 
    таким образом, пользователь может управлять рисунком (например — перемещать мышкой некоторые элементы[1]).
    https://svg-art.ru/
    https://svg-art.ru/?p=1253
    */
    public function cloneNode(int $key, ?int $targetNodeKey): void
    {
        
    }
    
    public function cloneNodeWithoutChildren(int $key, ?int $targetNodeKey): void
    {
        
    }
    
    public function updateNode(int $key, string $data): void
    {
        
    }
    
    /*public function getAllNodes(): array
    {
        
    }*/
    
    public function getRoot(): ?Node
    {
        return $this->root;
    }
    
    public function printChildrenLevel(Node $parentNode): void
    {
        foreach ($parentNode->getChildren() as $childNode) {
            echo $childNode->getKey() . " ";
        }

        echo  "==========\n"; 
    }
    
    public function printTree(Node $parentNode): void
    {
        if ($parentNode->haveChildren()) {
            $this->printChildrenLevel($parentNode);
            foreach ($parentNode->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $this->printTree($childNode);
                } else {
                    echo  "++++++++\n";
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
    
    private function getAllNodesWithBranches(Node $parentNode): array
    {
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

        return $this->nodesList;
    }
    
    public function createSvgImg(): void
    {
        $beginSvgString = '<svg width="1500" height="1500" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="white" />';
        
        //$nodes = $this->getAllNodes($this->root);
        $nodes = $this->getAllNodesWithBranches($this->root);
        //echo '<pre>';var_dump($nodes);die();
        
        $svgString = '<circle cx="'. $this->root->getX() .'" cy="'. $this->root->getY() .'" r="5" fill="green"/>';
        $svgString .= '<text x="'. $this->root->getX() + 15 .'" y="'. $this->root->getY() + 5 .'" font-size="16" text-anchor="middle" fill="black">'. $this->root->getKey() .'</text>';
        
        foreach ($nodes as $fullNode) {
            $currentNodes = $fullNode['nodes'];
            foreach ($currentNodes as $node) {
                $svgString .=  '<line x1="'. $fullNode['parentCoordinates'][0] .'" x2="'. $node->getX() 
                        .'" y1="'. $fullNode['parentCoordinates'][1] .'" y2="'. $node->getY() .'" stroke="orange" fill="transparent" stroke-width="1"/>';
                $svgString .= '<circle cx="'. $node->getX() .'" cy="'. $node->getY() .'" r="5" fill="green"/>';
                $svgString .= '<text x="'. $node->getX() + 15 .'" y="'. $node->getY() + 5 .'" font-size="16" text-anchor="middle" fill="black">'. $node->getKey() .'</text>';
            }    
        }
        
        $endSvgString = '</svg>';
        
        echo $beginSvgString . $svgString . $endSvgString;
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
