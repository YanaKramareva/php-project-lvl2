<?php

namespace Differ\Cli;

use Docopt;

use function Differ\Differ\start;

function gendiff()
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

    $diff = start(
        $args['<firstFile>'],
        $args['<secondFile>'],
        $args['--format']
    );
    print_r($diff);
}
