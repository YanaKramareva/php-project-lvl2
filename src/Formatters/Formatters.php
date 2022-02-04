<?php

namespace Differ\Formatters;

function selectFormatter(string $format): string
{
    switch ($format) {
        case "stylish":
            return 'Differ\Formatters\Stylish\stylish';
        case "plain":
            return 'Differ\Formatters\Plain\formatPlain';
        case "json":
            return 'Differ\Formatters\Json\formatJson';
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}
