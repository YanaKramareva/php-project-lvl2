<?php

namespace Differ\Formatters;

function formatAstToString(array $ast, string $format): string
{
    switch ($format) {
        case "stylish":
            return Stylish\formatStylish($ast);
        case "plain":
            return Plain\formatPlain($ast);
        case "json":
            return Json\formatJson($ast);
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}
