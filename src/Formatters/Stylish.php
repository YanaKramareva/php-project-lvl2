<?php

namespace Differ\Formatters\Stylish;

const SPACES = 4;
const INDENTS = ['unchanged' => '    ', 'added' => '  + ', 'deleted' => '  - ', 'parent' => '    '];

function stylish(array $ast): string
{
    return "{\n" . format($ast, 0) . "\n}";
}

function format(array $ast, int $level): string
{
    $notPlain = array_map(function ($item) use ($level) {
        return getBlock($item, $level);
    }, $ast);
    return implode("\n", $notPlain);
}

function getBlock(array $item, int $level): string
{
    $spaces = str_repeat(" ", $level * SPACES);
    $key = $item['key'];

    if ($item['type'] === 'parent') {
        $children = format($item['children'], $level + 1);
        return "{$spaces}    {$item['key']}: {\n{$children}\n    {$spaces}}";
    }

    if ($item['type'] === 'changed') {
        $beforeValue = formatValue($item['beforeValue'], $level + 1);
        $afterValue = formatValue($item['afterValue'], $level + 1);
        return "{$spaces}  - {$key}: {$beforeValue}\n" . "{$spaces}  + {$key}: {$afterValue}";
    }

    $value = formatValue($item['value'], $level + 1);
    $indent = INDENTS[$item['type']];
    return "{$spaces}{$indent}{$key}: {$value}";
}

function formatValue($value, int $level = 1): string
{
    if (is_array($value)) {
        $spaces = str_repeat(" ", $level * SPACES);
        $keys = array_keys($value);
        $result = array_map(function ($key) use ($level, $value, $spaces) {
            $formatValue = formatValue($value[$key], $level + 1);
            return "{$spaces}    {$key}: {$formatValue}";
        }, $keys);
        $result = implode("\n", $result);
        return "{\n{$result}\n{$spaces}}";
    }

    return (is_bool($value) || is_null($value)) ? toString($value) : (string) $value;
}

function toString($value): string
{
    if (is_null($value)) {
        return 'null';
    }

    return trim(var_export($value, true), "'");
}
