<?php

namespace LKSS\Console\Commands;

trait EditorHandler
{
    protected string $tempFile = '/tmp/test.txt';

    protected function getParamUsingEditor(): string
    {
        system("echo '' > $this->tempFile && nano $this->tempFile > `tty`");
        $data = file_get_contents($this->tempFile);
        system("rm $this->tempFile");

        return $data;
    }
}