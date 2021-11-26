<?php

namespace LKSS\Storage;

class StorageVisualizer
{
    public function printTree(Node $parentNode, string $separator): void
    {
        $separator = $separator . "----";
        echo $separator . $parentNode->getName() . " "
            . "[" . $parentNode->getKey(). "]" .  "\n";
        if ($parentNode->haveChildren()) {
            foreach ($parentNode->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $this->printTree($childNode, $separator);
                } else {
                    $separator = $separator . "----";
                    echo $separator . $childNode->getName() . " "
                        . "[" . $childNode->getKey(). "]" .  "\n";
                    $separator = substr($separator, 0, strlen($separator) -4);
                }
            }
        }
    }
}