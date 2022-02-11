<?php

namespace Differ\Formatters;

function formatAstToString(array $ast, string $format): string
{
    switch ($format) {
        case "stylish":
            return Stylish\format($ast);
        case "plain":
            return Plain\format($ast);
        case "json":
            return Json\format($ast);
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}
