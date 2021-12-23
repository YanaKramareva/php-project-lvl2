<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff;

class GenDiffTest extends TestCase
{
    public function testGenDiff()
    {
        $json1 = __DIR__ . "/./fixtures/file1.json";
        $json2 = __DIR__ . "/./fixtures/file2.json";

        $genDiff = explode(PHP_EOL, genDiff($json1, $json2));

        $expectation = array(' - follow: false',
            '   host: hexlet.io',
            ' - proxy: 123.234.53.22',
            ' - timeout: 50',
            ' + timeout: 20',
            ' + verbose: true');

        $this->assertEquals($expectation, $genDiff);
    }
}
