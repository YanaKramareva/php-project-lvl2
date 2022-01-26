<?php

namespace Differ\Parsers;

use Exception;
use Symfony\Component\Yaml\Yaml;

function parse($fileContent, $fileType)
{
    switch ($fileType) {
        case "yaml":
        case "yml":
            return Yaml::parse($fileContent);
        case "json":
            return json_decode($fileContent, true);
        default:
            throw new Exception('Unknown type of file ' . $fileType);
    }
}
