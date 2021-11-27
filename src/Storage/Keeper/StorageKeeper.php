<?php

namespace LKSS\Storage\Keeper;

use LKSS\Storage\Node;

/*
 * Save tree into file (Adjacency List)
 * https://bitworks.software/2017-10-20-storing-trees-in-rdbms.html
 */
class StorageKeeper implements StorageKeeperInterface
{
    /**
     * 1. get list of all nodes from storage
     * 2. save list into file
     */
    public function save(?Node $root): void
    {
        $nodesList = $this->getNodesList($root, []);
        $this->saveNodesListIntoFile($nodesList);
        $this->loadNodesListFromFile();
        echo '<pre>';var_dump($nodesList);die();
    }

    public function load(): ?Node
    {
        /**
         * 1. load list from file
         * 2. build storage tree from this list
         */

        return null;
    }

    /**
     * @TODO make with php Collections instead array
     */
    protected function getNodesList(?Node $node, array $list): array
    {
        $list[] = [
            'parent_key' => !is_null($node->getParent()) ? $node->getParent()->getKey() : null,
            'key' => $node->getKey(),
            'name' => $node->getName(),
            'data' => $node->getData(),
        ];
        if ($node->haveChildren()) {
            foreach ($node->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $list = $this->getNodesList($childNode, $list);
                } else {
                    $list[] = [
                        'parent_key' => $node->getKey(),
                        'key' => $childNode->getKey(),
                        'name' => $childNode->getName(),
                        'data' => $childNode->getData(),
                    ];
                }
            }
        }

        return $list;
    }

    protected function saveNodesListIntoFile(array $nodesList): void
    {   $fileName = 'data/local-storage.txt';
        //echo '<pre>';var_dump($nodesList[0]);die();
        file_put_contents($fileName, $nodesList[0], FILE_APPEND | LOCK_EX);

        $fp = fopen('data/local-storage.csv', 'w');
        foreach ($nodesList as $node) {
            fputcsv($fp, $node);
        }
    }

    protected function loadNodesListFromFile(): array
    {   $fileName = 'data/local-storage.txt';
        $nodesList = file_get_contents($fileName);
        echo '<pre>';var_dump($nodesList);die();
    }
}
