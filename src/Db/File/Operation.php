<?php

namespace LKSS\Db\File;

class Operation
{
    public const INSERT = 'insert';
    public const UPDATE = 'update';
    public const DELETE = 'delete';

    public static function make($filePointer, array $parentData, array $newData, string $operation): void
    {
        if ($operation == self::INSERT) {
            fputcsv($filePointer, $parentData);
            fputcsv($filePointer, $newData);
        } elseif ($operation == self::UPDATE) {
            fputcsv($filePointer, $newData);
        }
    }
}
