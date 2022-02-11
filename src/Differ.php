<?php

namespace Differ\Differ;

use function Differ\Ast\makeAst;
use function Differ\Formatters\formatAstToString;
use function Differ\Parsers\parse;

function fileGetContent(string $filePath): string
{
    if (!is_readable($filePath)) {
        throw new \Exception("Can't read file: " . $filePath);
    }
    return file_get_contents($filePath);
}

function genDiff(string $beforeFilePath, string $afterFilePath, string $format = 'stylish'): string
{
    $beforeContent = fileGetContent($beforeFilePath);
    $afterContent = fileGetContent($afterFilePath);
    $beforeType = pathinfo($beforeFilePath, PATHINFO_EXTENSION);
    $afterType = pathinfo($afterFilePath, PATHINFO_EXTENSION);
    $beforeParsedContent = parse($beforeContent, $beforeType);
    $afterParsedContent = parse($afterContent, $afterType);
    $ast = makeAst($beforeParsedContent, $afterParsedContent);
    return formatAstToString($ast, $format);
}
