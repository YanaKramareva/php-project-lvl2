<?php

namespace Differ\Ast;

function makeAst($beforeParsedContent, $afterParsedContent)
{
    $beforeKeys = array_keys($beforeParsedContent);
    $afterKeys = array_keys($afterParsedContent);
    $keys = array_unique(array_merge($beforeKeys, $afterKeys));
    sort($keys);
    return array_map(fn($key) => makeItemOfAst($key, $beforeParsedContent, $afterParsedContent), $keys);
}

function makeItemOfAst($key, $beforeParsedContent, $afterParsedContent)
{
    if (!array_key_exists($key, $beforeParsedContent)) {
        $afterValue = $afterParsedContent[$key];
        return ['type' => "added", 'key' => $key, 'value' => $afterValue];
    }
    if (!array_key_exists($key, $afterParsedContent)) {
        $beforeValue = $beforeParsedContent[$key];
        return ['type' => "deleted", 'key' => $key, 'value' => $beforeValue];
    }

    $beforeValue = $beforeParsedContent[$key];
    $afterValue = $afterParsedContent[$key];
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
