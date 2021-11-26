<?php

namespace LKSS\Storage;

/**
 *
 * @author porfirovskiy
 */
interface NodeInterface
{
    public function getKey(): string;
    public function getName(): string;
    public function getData(): string;
}
