<?php

namespace Differ\Formatters;

function selectFormatter(array $ast, string $format): string
{
    switch ($format) {
        case "stylish":
            return Stylish\stylish($ast);
        case "plain":
            return Plain\formatPlain($ast);
        case "json":
            return Json\formatJson($ast);
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}
