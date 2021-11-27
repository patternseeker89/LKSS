<?php

namespace LKSS\Storage;

class StorageVisualizer
{
    public const SEPARATOR_DEFAULT = '    ';

    public function printTree(Node $parentNode, string $separator): void
    {
        $separator = $this->increaseSeparator($separator);
        $this->printCurrentNodeString($parentNode->getKey(), $parentNode->getName(), $separator);
        if ($parentNode->haveChildren()) {
            foreach ($parentNode->getChildren() as $childNode) {
                if (!\is_null($childNode->getChildren())) {
                    $this->printTree($childNode, $separator);
                } else {
                    $separator = $this->increaseSeparator($separator);
                    $this->printCurrentNodeString($childNode->getKey(), $childNode->getName(), $separator);
                    $separator = substr($separator, 0, strlen($separator) -4);
                }
            }
        }
    }

    protected function printCurrentNodeString(string $key, string $name, string $separator): void
    {
        if ($separator == self::SEPARATOR_DEFAULT) {
            echo ' ' . $name . " " . "[" . $key . "]" . "\n";
        } else {
            echo $separator . $name . " " . "[" . $key . "]" . "\n";
        }
    }

    protected function increaseSeparator(string $separator): string
    {
        return $separator . self::SEPARATOR_DEFAULT;
    }
}
