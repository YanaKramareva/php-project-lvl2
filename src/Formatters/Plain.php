<?php

namespace Differ\Formatters\Plain;

use function Differ\Formatters\Stylish\toString;

function formatPlain(array $ast): string
{
    return format($ast, "");
}

function format(array $ast, int $level): ?string
{
    $plain = array_map(fn ($item) => getBlock($item, $level), $ast);
    return implode("\n", array_filter($plain, fn($item) => $item !== null));
}

function getBlock(array $item, int $level): ?string
{
    $key = $item['key'];
    $newLevel = strlen($level) > 0 ? "{$level}.{$key}" : $key;
    switch ($item['type']) {
        case 'added':
            $value = formatValue($item['value']);
            return "Property '{$newLevel}' was added with value: {$value}";
        case 'deleted':
            return "Property '{$newLevel}' was removed";
        case 'changed':
            $beforeValue = formatValue($item['beforeValue']);
            $afterValue = formatValue($item['afterValue']);
            return "Property '{$newLevel}' was updated." .
                " From {$beforeValue} to {$afterValue}";
        case 'parent':
            return format($item['children'], $newLevel) ;
        case 'unchanged':
            return null;
        default:
            throw new \Exception("Unknown type: '{$item['type']}' of ast item: '{$key}");
    }
}

function formatValue($value): string
{
    if (is_bool($value) || is_null($value)) {
        return toString($value);
    }
    if (is_array($value) || is_object($value)) {
        return '[complex value]';
    }
    if (is_string($value)) {
        return "'{$value}'";
    }
        return "{$value}";
}
