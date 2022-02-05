<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class GenDiffTest extends TestCase
{
    public string $expectedPlainJson;
    public string $expectedStylish;

    public function setUp(): void
    {
        parent::setUp();
        $this->expectedPlainJson =  file_get_contents(__DIR__ . "/fixtures/expectedPlain");
        $this->expectedStylish = file_get_contents(__DIR__ . "/fixtures/expectedStylish");
    }

    public function testGenDiffPlainJson()
    {
        $actualJson = genDiff(__DIR__ . "/fixtures/beforeNested.json", __DIR__ . "/fixtures/afterNested.json", "plain");
        $this->assertEquals($this->expectedPlainJson, $actualJson);
    }

   /* public function testGenDiffStylishJson()
    {
        $actualJson = genDiff(__DIR__ . "/fixtures/beforeNested.json",
   __DIR__ . "/fixtures/afterNested.json", "stylish");
        $this->assertEquals($this->expectedStylish, $actualJson);
    }

    public function testGenDiffStylishYaml()
    {
        $actualJson = genDiff(__DIR__ . "/fixtures/beforeNested.json",
   __DIR__ . "/fixtures/afterNested.json", "stylish");
        $this->assertEquals($this->expectedStylish, $actualJson);
    }
*/
    public function testGenDiffPlainYaml()
    {
        $actualYaml = genDiff(__DIR__ . "/fixtures/beforeNested.yaml", __DIR__ . "/fixtures/afterNested.yaml", "plain");
        $this->assertEquals($this->expectedPlainJson, $actualYaml);
    }
}
