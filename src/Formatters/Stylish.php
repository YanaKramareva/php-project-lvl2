<?php

namespace Differ\Formatters\Stylish;

const SPACES = 4;
const INDENTS = ['unchanged' => '    ', 'added' => '  + ', 'deleted' => '  - ', 'parent' => '    '];

function formatStylish(mixed $ast, int $depth = 0): string
{
    $stylish = array_map(function ($item) use ($depth) {
        return getBlock($item, $depth);
    }, $ast);
    $stylishToString = implode("\n", $stylish);
    return $depth === 0 ?  "{\n{$stylishToString}\n}" : $stylishToString;
}

function getBlock(array $item, int $depth): string
{
    $spaces = str_repeat(" ", $depth * SPACES);
    $key = $item['key'];
    if ($item['type'] === 'parent') {
        $indent = INDENTS[$item['type']];
        $children = formatStylish($item['children'], $depth + 1);
        return "{$spaces}{$indent}{$key}: {\n{$children}\n{$indent}{$spaces}}";
    }

    if ($item['type'] === 'changed') {
        $beforeValue = formatValue($item['beforeValue'], $depth + 1);
        $afterValue = formatValue($item['afterValue'], $depth + 1);
        return "{$spaces}  - {$key}: {$beforeValue}\n" . "{$spaces}  + {$key}: {$afterValue}";
    }

    $value = formatValue($item['value'], $depth + 1);
    $indent = INDENTS[$item['type']];
    return "{$spaces}{$indent}{$key}: {$value}";
}

function formatValue(mixed $value, int $depth = 1): string
{
    if (is_array($value)) {
        $spaces = str_repeat(" ", $depth * SPACES);
        $keys = array_keys($value);
        $result = array_map(function ($key) use ($depth, $value, $spaces) {
            $formatValue = formatValue($value[$key], $depth + 1);
            return "{$spaces}    {$key}: {$formatValue}";
        }, $keys);
        $finishResult = implode("\n", $result);
        return "{\n{$finishResult}\n{$spaces}}";
    }
    if (is_null($value)) {
        return 'null';
    }
    if (is_bool($value)) {
        return trim(var_export($value, true), "'");
    }
    return $value;
}
