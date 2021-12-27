<?php

namespace Parsers;

use Symfony\Component\Yaml\Yaml;

function makeArrayFromJson($file): array
{
    $fileContent = file_get_contents($file);
    return json_decode($fileContent, true);
}

function makeArrayFromYaml($file): array
{
    return Yaml::parseFile($file);
}

function chooseFormatToParse(string $path)
{
    switch ($path) {
        case strchr($path, '.json') === '.json':
            return makeArrayFromJson($path);
        case strchr($path, '.yml') === '.yml':
            return makeArrayFromYaml($path);
    }
}
