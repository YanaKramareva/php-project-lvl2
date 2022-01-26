<?php

namespace Differ\Differ\GenDiff;

use function Differ\Ast\makeAst;
use function Differ\Format\selectFormatter;
use function Differ\Parsers\parse;

function fileGetContent($filePath)
{
    $content = file_get_contents($filePath);
    if (!$content) {
        throw new \Exception("Can't read file: " . $filePath);
    }
    return $content;
}

function genDiff($beforeFilePath, $afterFilePath, $format = 'stylish')
{
    $beforeContent = fileGetContent($beforeFilePath);
    $afterContent = fileGetContent($afterFilePath);
    $beforeType = pathinfo($beforeFilePath, PATHINFO_EXTENSION);
    $afterType = pathinfo($afterFilePath, PATHINFO_EXTENSION);
    $beforeParsedContent = parse($beforeContent, $beforeType);
    ksort($beforeParsedContent);
    $afterParsedContent = parse($afterContent, $afterType);
    ksort($afterParsedContent);
    $formater = selectFormatter($format);
    $ast = array_values(makeAst($beforeParsedContent, $afterParsedContent));
    return $formater($ast);
}
