<?php

namespace Differ\Cli;

use Docopt;

use function Differ\Differ\genDiff;

function start(): string
{
    $doc = <<<'DOCOPT'
    Generate diff
    Usage:
      gendiff (-h|--help)
      gendiff (-v|--version)
      gendiff [--format <fmt>] <firstFile> <secondFile>
    Options:
      -h --help                     Show this screen
      -v --version                  Show version
      --format <fmt>                Report format [default: stylish]
    DOCOPT;

    $args = Docopt::handle($doc, ['version' => '1.0']);

    $diff = genDiff(
        $args['<firstFile>'],
        $args['<secondFile>'],
        $args['--format']
    );
    return $diff;
}
