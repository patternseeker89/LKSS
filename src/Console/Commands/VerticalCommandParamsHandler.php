<?php

namespace LKSS\Console\Commands;

use http\Exception;

class VerticalCommandParamsHandler
{
    use EditorHandler;
    use FileHandler;

    public const HANDLER_TYPE_STRING = 'string';
    public const HANDLER_TYPE_FILE = 'file';
    public const HANDLER_TYPE_EDITOR = 'editor';

    /**
     * @throws \Exception
     */
    public function getParams(int $paramsNumber, array $paramsList): array
    {
        $filledParamsList = [];
        if (count($paramsList) == $paramsNumber) {
            $i = 1;
            while ($i <= $paramsNumber) {
                $currentParamName = array_key_first($paramsList);
                $currentParamHandlerType = array_shift($paramsList);
                echo ">> $currentParamName: ";
                $filledParamsList[$currentParamName] = $this->getParamByType($currentParamHandlerType);
                $i++;
            }
            echo "\n";
        } else {
            throw new \Exception('Bad count of params!');
        }

        return $filledParamsList;
    }

    protected function getStringParam(): string
    {
        return stream_get_line(STDIN, 999999, "\n");
    }

    protected function getParamByEditor(): string
    {
        return trim($this->getParamUsingEditor(), "\n");
    }

    protected function getParamByFile(): string
    {
        return '';
    }

    protected function getParamByType(string $paramHandlerType): string
    {
        if ($paramHandlerType == static::HANDLER_TYPE_STRING) {
            $result = $this->getStringParam();
        } elseif ($paramHandlerType == static::HANDLER_TYPE_EDITOR) {
            $result = $this->getParamByEditor();
        }
        elseif ($paramHandlerType == static::HANDLER_TYPE_FILE) {
            $result = $this->getParamByFile();
        } else {
            throw new \Exception('Unknown param`s handler type!');
        }

        return $result;
    }
}
