<?php

namespace Differ;

use function Functional\zip_all;

function makeArrayFromFile($file)
{
    $arrayFromFile =  file_get_contents($file);
    return json_decode($arrayFromFile, true);
}


function zipArrays(array $arrayFromFile1, $arrayFromFile2): array
{
    $zipArrays = zip_all($arrayFromFile1, $arrayFromFile2);
    uksort($zipArrays, function ($left, $right) {
        return strcmp($left, $right);
    });
     return $zipArrays;
}

function formatBoolToString($item): ?string
{
    if (!is_bool($item)) {
        return $item;
    }
        return $item ? 'true' : 'false';
}

function compareTree(array $tree): array
{
    $result = [];
    foreach ($tree as $item => $value) {
        foreach ($value as $key => $val) {
            $value[$key] = formatBoolToString($val);
        }
        switch ($value) {
            case is_null($value[0]):
                $result[] = " + $item: $value[1]";
                break;
            case is_null($value[1]):
                $result[] = " - $item: $value[0]";
                break;
            case $value[0] === $value[1]:
                $result[] = "   $item: $value[1]";
                break;
            case ($value[0] !== $value[1]):
                $result[] = " - $item: $value[0]";
                $result[] = " + $item: $value[1]";
                break;
        }
    }
                return $result;
}

function genDiff(array $arrayFromFile1, array $arrayFromFile2): string
{
    $zipFilesArray = zipArrays($arrayFromFile1, $arrayFromFile2);
    $result = compareTree($zipFilesArray);
    return implode(PHP_EOL, $result);
}
