<?php

namespace Differ;

use function Functional\zip_all;

function makeArrayFromFile($file)
{
    $arrayFromFile =  file_get_contents($file);
    return json_decode($arrayFromFile, true);
}


function genDiff($file1, $file2): string
{
    $zipFilesArray = zip_all(makeArrayFromFile($file1), makeArrayFromFile($file2));
    uksort($zipFilesArray, function ($left, $right) {
        return strcmp($left, $right);
    });
    $result = [];
    foreach ($zipFilesArray as $item => $value) {
        if (is_bool($value[0])) {
            $value[0] = ($value[0] === true ? 'true' : 'false');
        }
        if (is_bool($value[1])) {
            $value[1] = ($value[1] === true ? 'true' : 'false');
        }
        if (is_null($value[0])) {
            $result[] =  " + $item: $value[1]";
        }
        if (is_null($value[1])) {
            $result[] = " - $item: $value[0]";
        }
        if ($value[0] === $value[1]) {
            $result[] =  "   $item: $value[1]";
        }
        if ($value[0] !== $value[1] && $value[0] !== null && $value[1] !== null) {
            $result[] = " - $item: $value[0]";
            $result[] = " + $item: $value[1]";
        }
    }
    return implode(PHP_EOL, $result);
}

