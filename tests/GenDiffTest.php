<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\compareTree;
use function Differ\genDiff;
use function Differ\makeArrayFromFile;
use function Differ\zipArrays;

class GenDiffTest extends TestCase
{
    private string $json1;
    private string $json2;

    public function setUp(): void
    {
        $this->json1 = __DIR__ . "/./fixtures/file1.json";
        $this->json2 = __DIR__ . "/./fixtures/file2.json";
    }

    public function testZipArrays()
    {
        $array1 = makeArrayFromFile($this->json1);
        $array2 = makeArrayFromFile($this->json2);
        $zippedArrays = zipArrays($array1, $array2);

        $expectation =
            ['follow' => ['0' => '', '1' => ''],
            'host' => ['0' => 'hexlet.io', '1' => 'hexlet.io'],
            'proxy' => ['0' => '123.234.53.22', '1' => ''],
            'timeout' => ['0' => 50, '1' => 20],
            'verbose' => ['0' => '', '1' => 1]];

        $this->assertEquals($expectation, $zippedArrays);
    }

    public function testCompareTree()
    {
        $array1 = makeArrayFromFile($this->json1);
        $array2 = makeArrayFromFile($this->json2);
        $zippedArrays = zipArrays($array1, $array2);
        $comparedTree = compareTree($zippedArrays);

        $expectation = [
            '0' =>  ' - follow: false',
            '1' =>  '   host: hexlet.io',
            '2' =>  ' - proxy: 123.234.53.22',
            '3' =>  ' - timeout: 50',
            '4' =>  ' + timeout: 20',
            '5' =>  ' + verbose: true'];

        $this->assertEquals($expectation, $comparedTree);
    }

    public function testMakeArrayFromFile()
    {
        $array1 = makeArrayFromFile($this->json1);

        $expectation = ['host' => 'hexlet.io', 'timeout' => '50', 'proxy' => '123.234.53.22', 'follow' => ''];

        $this->assertEquals($expectation, $array1);
    }

    public function testGenDiff()
    {
        $array1 = makeArrayFromFile($this->json1);
        $array2 = makeArrayFromFile($this->json2);
        $genDiff = explode(PHP_EOL, genDiff($array1, $array2));

        $expectation = array(' - follow: false',
            '   host: hexlet.io',
            ' - proxy: 123.234.53.22',
            ' - timeout: 50',
            ' + timeout: 20',
            ' + verbose: true');

        $this->assertEquals($expectation, $genDiff);
    }
}
