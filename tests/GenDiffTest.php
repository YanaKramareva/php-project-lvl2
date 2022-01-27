<?php

namespace Differ\Tests\GenDiffTest;

use function \Differ\Differ\gendiff;
use PHPUnit\Framework\TestCase;

class GenDiffTest extends TestCase
{
    public function testGenDiffJson()
    {
        $expected1 = file_get_contents(__DIR__ . "/fixtures/expectedFlat");
        $actual1 = gendiff(__DIR__ . "/fixtures/beforeFlat.json", __DIR__ . "/fixtures/afterFlat.json", "stylish");
        $this->assertEquals($expected1, $actual1);

        /*$expected2 = file_get_contents(__DIR__ . "/fixtures/expectedStylish");
        $actual2 = gendiff(__DIR__ . "/fixtures/beforeNested.json", __DIR__ . "/fixtures/afterNested.json", "stylish");
        $this->assertEquals($expected2, $actual2);*/

        $expected3 = file_get_contents(__DIR__ . "/fixtures/expectedPlain");
        $actual3 = gendiff(__DIR__ . "/fixtures/beforeNested.json", __DIR__ . "/fixtures/afterNested.json", "plain");
        $this->assertEquals($expected3, $actual3);

        $expected4 = file_get_contents(__DIR__ . "/fixtures/expected.json");
        $actual4 = gendiff(__DIR__ . "/fixtures/beforeFlat.json", __DIR__ . "/fixtures/afterFlat.json", "json");
        $this->assertEquals($expected4, $actual4);
    }

    public function testGenDiffYaml()
    {
        $expected = file_get_contents(__DIR__ . "/fixtures/expectedFlat");
        $actual = gendiff(__DIR__ . "/fixtures/beforeFlat.yml", __DIR__ . "/fixtures/afterFlat.yml", 'stylish');
        $this->assertEquals($expected, $actual);

        $expected2 = file_get_contents(__DIR__ . "/fixtures/expectedPlain");
        $actual2 = gendiff(__DIR__ . "/fixtures/beforeNested.yaml", __DIR__ . "/fixtures/afterNested.yaml", "plain");
        $this->assertEquals($expected2, $actual2);
    }
}
