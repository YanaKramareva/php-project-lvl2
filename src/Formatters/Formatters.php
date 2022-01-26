<?php

namespace Differ\Format;

function selectFormatter($format)
{
    switch ($format) {
        case "stylish":
            return 'Differ\Formatters\Stylish\stylish';
        case "plain":
            return 'Differ\Formatters\Plain\formatPlain';
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}
