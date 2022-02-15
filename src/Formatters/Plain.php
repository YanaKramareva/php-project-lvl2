<?php

namespace Differ\Formatters\Plain;

function format(array $ast): string
{
    return formatPlain($ast, "");
}

function formatPlain(array $ast, string $depth): string
{
    $plain = array_map(function ($item) use ($depth) {
        $key = $item['key'];
        $newLDepth = strlen($depth) > 0 ? "{$depth}.{$key}" : $key;
        switch ($item['type']) {
            case 'added':
                $value = formatValue($item['value']);
                return "Property '{$newLDepth}' was added with value: {$value}";
            case 'deleted':
                return "Property '{$newLDepth}' was removed";
            case 'changed':
                $beforeValue = formatValue($item['beforeValue']);
                $afterValue = formatValue($item['afterValue']);
                return "Property '{$newLDepth}' was updated." .
                    " From {$beforeValue} to {$afterValue}";
            case 'parent':
                return formatPlain($item['children'], $newLDepth);
            case 'unchanged':
                return null;
            default:
                throw new \Exception("Unknown type: '{$item['type']}' of ast item: '{$key}");
        }
    }, $ast);
    return implode("\n", array_filter($plain, fn($item) => $item !== null));
}

function formatValue(mixed $value): string
{
    if (is_null($value)) {
        return 'null';
    }
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_array($value) || is_object($value)) {
        return '[complex value]';
    }
    if (is_string($value)) {
        return "'{$value}'";
    }
        return "{$value}";
}
