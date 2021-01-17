<?php

class Node
{
    private int $key;
    private string $data = '';
    private Node $parent;
    private ?array $children;

    public function __construct(string $data)
    {
        $this->key = rand(0, 1000000);
        $this->data = $data;
        $this->children = null;
    }
    
    public function setParent(Node $parent): void
    {
        $this->parent = $parent;
    }
    
    public function addChild(Node $childNode): void
    {
        $this->children[] = $childNode;
    }
    
    public function getKey(): int
    {
        return $this->key;
    }
    
    public function getChildren(): ?array
    {
        return $this->children;
    }

    public function getData(): string
    {
        return $this->data;
    }
}
