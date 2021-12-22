<?php

namespace Differ;

use function Functional\zip_all;

function makeArrayFromFile($file)
{
    $arrayFromFile =  file_get_contents($file);
    return json_decode($arrayFromFile, true);
}

function zipFilesToArray($file1, $file2): array
{
    $zipFilesArray = zip_all(makeArrayFromFile($file1), makeArrayFromFile($file2));
    uksort($zipFilesArray, function ($left, $right) {
        return strcmp($left, $right);
    });
    return $zipFilesArray;
}

function formatBoolToString($item): ? string
{
    if (is_bool($item)) {
        $value = ($item === true ? 'true' : 'false');
    }
    else {
        $value = $item;
    }
    return $value;
}

function genDiff($file1, $file2): string
{
    $zipFilesArray = zipFilesToArray($file1, $file2);
    $result = [];
    foreach ($zipFilesArray as $item => $value) {
        foreach ($value as $key => $val) {
            $value[$key] = formatBoolToString($val);
        }
        switch ($value) {
            case is_null($value[0]):
                $result[] =  " + $item: $value[1]";
                break;
            case is_null($value[1]):
                $result[] = " - $item: $value[0]";
                break;
            case $value[0] === $value[1]:
                $result[] =  "   $item: $value[1]";
                break;
            case ($value[0] !== $value[1]):
                $result[] = " - $item: $value[0]";
                $result[] = " + $item: $value[1]";
                break;
        }
    }
    return implode(PHP_EOL, $result);
}
