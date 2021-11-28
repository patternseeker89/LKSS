<?php

namespace LKSS\Config;

/**
 * add yaml config or make it interactive setup in command line env.
 */
class AppConfig
{
    private array $list = [
        'editor' => 'nano',
        'tmpEditorFilePath' => '',
        'db' => [
            'drive' => '',
            'dbFileName' => '/data/storage.csv',
            'dbTempFileName' => '/data/temp-storage.csv',
        ]
    ];

    public function getProperty(string $name): mixed
    {
        $property = null;
        if (isset($this->list[$name])) {
            $property = $this->list[$name];
        }

        return $property;
    }
}
