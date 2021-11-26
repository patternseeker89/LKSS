<?php

namespace LKSS\Storage\Node;

class KeyGenerator
{
    public static function generateRandomKey(): string
    {
        return bin2hex(random_bytes(10));
    }
}