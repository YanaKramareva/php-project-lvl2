<?php

namespace Differ\Format;

function selectFormatter($format)
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
