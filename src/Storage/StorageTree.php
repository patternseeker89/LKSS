<?php

namespace LKSS\Storage;

use LKSS\Db\DbInterface;
use LKSS\Db\File\CsvFileDb;
use LKSS\Storage\Keeper\StorageKeeperInterface;
use LKSS\Storage\Node;
use LKSS\Storage\StorageTreeInterface;

class StorageTree implements StorageTreeInterface
{
    private const ERROR_MESSAGE_NODE_NOT_FOUND = "Node does not exist for this key!\n";

    private ?Node $root = null;
    private StorageKeeperInterface $keeper;
    private StorageVisualizer $visualizer;
    private DbInterface $db;

    public function __construct(
        StorageKeeperInterface $keeper,
        StorageVisualizer $visualizer,
        CsvFileDb $csvFileDb,
    ) {
        $this->keeper = $keeper;
        $this->visualizer = $visualizer;
        $this->db = $csvFileDb;
        $this->root = $this->keeper->load($this);
    }

    public function __destruct()
    {
        //$this->keeper->save($this->root);
    }

    /**
     * @TODO refactoring of this method
     * separate into other class InsertNode example
     */
    public function insertNode(?string $parentKey, ?string $key, string $name, string $data, bool $isOnlyMemory = false): void
    {
        $newNode = new Node($key, $name, $data);

        if (!$isOnlyMemory) {
            if ($this->db->insert(
                $parentKey,
                [$parentKey, $newNode->getKey(), $name, str_replace("\n", "\\n", $data)]
            )) {
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
            } else {
                echo "Error: new node don`t saved in db!\n";
            }
        } else {
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
    }

    /**
     * @TODO refactoring of this method
     * separate into other class
     */
    public function deleteNode(string $key): void
    {
        $node = $this->getNodeByKey($key);

        if (!\is_null($node)) {
            $parent = $node->getParent();
            if (\is_null($parent)) {
                unset($this->root);
            } else {
                if (!$node->haveChildren()) {
                    if ($this->db->delete($key)) {
                        $parent->deleteChild($key);
                    } else {
                        echo self::ERROR_MESSAGE_NODE_NOT_FOUND;
                    }
                } else {
                    echo "Error: this node have children!\n";
                }
            }
        } else {
            echo "Error: cannot delete node in db!\n";
        }
    }

    public function moveNode(string $nodeKey, string $targetNodeKey): void
    {
        $node = $this->getNodeByKey($nodeKey);
        $targetNode = $this->getNodeByKey($targetNodeKey);

        if (!\is_null($node) && !\is_null($targetNode)) {
            if (!$node->haveChildren()) {
                $this->deleteNode($nodeKey);
                $node->setParent($targetNode);
                $targetNode->addChild($node);
            } else {
                echo "Error: this node have children!\n";
            }
        } else {
            echo "Wrong current or target node key!\n";
        }
    }

    public function cloneNode(string $key, string $targetNodeKey): void
    {
        $node = $this->getNodeByKey($key);
        $targetNode = $this->getNodeByKey($targetNodeKey);

        if (!\is_null($node) && !\is_null($targetNode)) {
            if (!$node->haveChildren()) {
                $newNode = new Node(null, $node->getName(), $node->getData());
                $newNode->setParent($targetNode);
                $targetNode->addChild($newNode);
            } else {
                echo "Error: this node have children!\n";
            }
        } else {
            echo "Wrong current or target node key!\n";
        }
    }

    public function updateNode(string $key, string $data): void
    {
        $node = $this->getNodeByKey($key);

        if (!\is_null($node)) {
            if ($this->db->update(
                $key,
                [$node->getParent()->getKey(), $node->getKey(), $node->getName(), str_replace("\n", "\\n", $data)])
            ) {
                $node->setData($data);
            } else {
                echo "Error: cannot update node in db!\n";
            }
        } else {
            echo self::ERROR_MESSAGE_NODE_NOT_FOUND;
        }
    }
    
    public function renameNode(string $key, string $newName): void
    {
        $node = $this->getNodeByKey($key);

        if (!\is_null($node)) {
            $node->setName($newName);
        } else {
            echo self::ERROR_MESSAGE_NODE_NOT_FOUND;
        }
    }

    public function getRoot(): ?Node
    {
        return $this->root;
    }

    public function printTree(Node $parentNode, string $separator = ''): void
    {
        $this->visualizer->printTree($parentNode, $separator);
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
     *  Depth-first search (DFS) used, my realization
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

    public function getCountOfNodes(Node $parentNode, int $counter = 0): int
    {
        $counter++;
        if ($parentNode->haveChildren()) {
            foreach ($parentNode->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $counter = $this->getCountOfNodes($childNode, $counter);
                } else {
                    $counter++;
                }
            }  
        }

        return $counter;
    }
}
