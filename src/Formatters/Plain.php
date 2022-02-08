<?php

namespace Differ\Formatters\Plain;

function formatPlain(array $ast): string
{
    return format($ast, "");
}

function format(array $ast, string $level): string
{
    $plain = array_map(fn ($item) => getBlock($item, $level), $ast);
    return implode("\n", array_filter($plain, fn($item) => $item !== null));
}

function getBlock(array $item, string $level): ?string
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

function formatValue(mixed $value): string
{
    if (is_null($value)) {
        return 'null';
    }
    if (is_bool($value)) {
        return trim(var_export($value, true), "'");
    }
    if (is_array($value) || is_object($value)) {
        return '[complex value]';
    }
    if (is_string($value)) {
        return "'{$value}'";
    }
        return "{$value}";
}
