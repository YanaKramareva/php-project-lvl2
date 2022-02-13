<?php

namespace Differ\Formatters\Stylish;

const SPACES = 4;
const INDENTS = ['unchanged' => '    ', 'added' => '  + ', 'deleted' => '  - ', 'parent' => '    '];

function format(mixed $ast): string
{
    return formatStylish($ast);
}

function formatStylish(mixed $ast, int $depth = 0): string
{
    $stylish = array_map(function ($item) use ($depth) {
        $spaces = str_repeat(" ", $depth * SPACES);
        $key = $item['key'];
        $output = fn($spaces, $indent, $key)=>"{$spaces}{$indent}{$key}: ";
        switch ($item['type']) {
            case $item['type'] === 'parent':
                $indent = INDENTS[$item['type']];
                $children = formatStylish($item['children'], $depth + 1);
                return "{$output($spaces,$indent, $key)}{\n{$children}\n{$indent}{$spaces}}";
            case $item['type'] === 'changed':
                $beforeValue = formatValue($item['beforeValue'], $depth + 1);
                $afterValue = formatValue($item['afterValue'], $depth + 1);
                $indentDeleted = INDENTS['deleted'];
                $indentAdded = INDENTS['added'];
                return "{$output($spaces,$indentDeleted, $key)}{$beforeValue}\n" .
                    "{$output($spaces,$indentAdded, $key)}{$afterValue}";
            case $item['type'] === 'unchanged':
            case $item['type'] === 'added':
            case $item['type'] === 'deleted':
                $value = formatValue($item['value'], $depth + 1);
                $indent = INDENTS[$item['type']];
                return "{$output($spaces,$indent, $key)}{$value}";
            default:
                throw new \Exception("This type: {$item['type']} is not supported.");
        }
    }, $ast);
    $stylishToString = implode("\n", $stylish);
    return $depth === 0 ?  "{\n{$stylishToString}\n}" : $stylishToString;
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
