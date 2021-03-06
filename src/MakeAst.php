<?php

namespace Differ\Ast;

use function Functional\sort;

function makeAst(mixed $beforeParsedContent, mixed $afterParsedContent): array
{
    $beforeKeys = array_keys($beforeParsedContent);
    $afterKeys = array_keys($afterParsedContent);
    $keys = array_unique(array_merge($beforeKeys, $afterKeys));
    $sortedKeys = sort($keys, fn ($a, $b) => strcmp($a, $b), false);
    return array_map(fn($key) => makeItemOfAst($key, $beforeParsedContent, $afterParsedContent), $sortedKeys);
}

function makeItemOfAst(string $key, mixed $beforeParsedContent, mixed $afterParsedContent): array
{
    $beforeValue = $beforeParsedContent[$key] ?? null;
    $afterValue = $afterParsedContent[$key] ?? null;

    if (!array_key_exists($key, $beforeParsedContent)) {
        return ['type' => "added", 'key' => $key, 'value' => $afterValue];
    }
    if (!array_key_exists($key, $afterParsedContent)) {
        return ['type' => "deleted", 'key' => $key, 'value' => $beforeValue];
    }
    if (is_array($beforeValue) && is_array($afterValue)) {
        return [
            'type' => "parent",
            'key' => $key,
            'children' => array_values(makeAst($beforeValue, $afterValue))];
    }
    if ($beforeValue !== $afterValue) {
        return [
            'type' => "changed",
            'key' => $key,
            'beforeValue' => $beforeValue,
            'afterValue' => $afterValue
        ];
    }
    return ['type' => "unchanged", 'key' => $key, 'value' => $beforeValue];
}
