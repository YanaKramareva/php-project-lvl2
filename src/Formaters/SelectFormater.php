<?php

namespace Differ\Format;

function selectFormater($format)
{
    switch ($format) {
        case "stylish":
            return 'Differ\Formaters\Stylish\stylish';
        case "plain":
            return 'Differ\Formaters\Plain\formatPlain';
        case "json":
            return 'Differ\Formaters\Json\formatJson';
        default:
            throw new \Exception('Unknown format: ' . $format);
    }
}
