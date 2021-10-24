<?php

namespace LKSS;

class Node
{
    private string $key;
    private string $name; // Privat bank, Deposit Standart Dollar
    private sting $type;//['standart', 'history', 'history item'] -> in ENUM object move this values!!! 'history item' -> linked list
    private sting $status;//['active', 'no active']
    private string $data = '';
    private ?Node $parent;
    private ?array $children;

    public function __construct(string $name, string $data)
    {
        $this->key = bin2hex(random_bytes(18));
        $this->name = $name;
        $this->data = $data;
        $this->children = null;
        $this->parent = null;
    }

    public function setParent(Node $parent): void
    {
        $this->parent = $parent;
    }

    public function addChild(Node $childNode): void
    {
        $this->children[] = $childNode;
    }

    public function deleteChild(int $childNodeKey): void
    {
        foreach ($this->children as $index => $child) {
            if ($child->key === $childNodeKey) {
                unset($this->children[$index]);
            }
        }
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getChildren(): ?array
    {
        return $this->children;
    }

    public function haveChildren(): bool
    {
        return !empty($this->children);
    }

    public function getParent(): ?Node
    {
        return $this->parent;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
