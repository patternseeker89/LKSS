<?php

namespace LKSS\Storage\Keeper;

use LKSS\Storage\Node;
use LKSS\Storage\StorageTreeInterface;

class CsvStorageKeeper implements StorageKeeperInterface
{
    private string $storageFileName = 'data/storage.csv';

    public function save(?Node $root): void
    {
        if (!is_null($root)) {
            $nodesList = $this->getNodesList($root, []);
            $this->saveNodesListIntoFile($nodesList);
        }
    }

    public function load(StorageTreeInterface $storage): ?Node
    {
        $rootNode = null;
        if (file_exists($this->storageFileName)) {
            $nodesList = $this->loadNodesListFromFile();
            $rootNode = $this->buildStorageTree($storage, $nodesList);
        }

        return $rootNode;
    }

    /**
     * @TODO make with php Collections instead array
     */
    protected function getNodesList(?Node $node, array $list): array
    {
        $parentKey = !is_null($node->getParent()) ? $node->getParent()->getKey() : null;
        $list[] = $this->addNodeToList($parentKey, $node);
        if ($node->haveChildren()) {
            $list = $this->handleChildrenNodes($node, $list);
        }

        return $list;
    }

    protected function addNodeToList(?string $parentKey, Node $node): array
    {
        return [
            'parent_key' => $parentKey,
            'key' => $node->getKey(),
            'name' => $node->getName(),
            'data' => str_replace("\n", "\\n", $node->getData()),
        ];
    }

    protected function handleChildrenNodes(Node $node, array $list): array
    {
        foreach ($node->getChildren() as $childNode) {
            if (!\is_null($childNode->getChildren())) {
                $list = $this->getNodesList($childNode, $list);
            } else {
                $list[] = $this->addNodeToList($node->getKey(), $childNode);
            }
        }

        return $list;
    }

    /**
     * @TODO use SplFileObject instead fopen()
     */
    protected function saveNodesListIntoFile(array $nodesList): void
    {
        $filePointer = fopen($this->storageFileName, 'w');
        foreach ($nodesList as $node) {
            fputcsv($filePointer, $node);
        }
    }

    protected function loadNodesListFromFile(): array
    {
        $lines = file($this->storageFileName);
        $nodesList = [];
        foreach ($lines as $line) {
            $nodesList[] = str_getcsv($line, ",", '"', "\n");
        }

        return $nodesList;
    }

    protected function buildStorageTree(StorageTreeInterface $storage, array $nodesList): ?Node
    {
        $isRootNode = true;
        foreach ($nodesList as $node) {
            if ($isRootNode) {
                $parentKey = null;
                $isRootNode = false;
            } else {
                $parentKey = $node[0];
            }

            $storage->insertNode($parentKey, $node[1], $node[2], str_replace("\\n", "\n", $node[3]));
        }

        return $storage->getRoot();
    }
}
