<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class GenDiffTest extends TestCase
{
    public string $expectedPlainJson;
    public string $expectedStylish;
    public string $beforeNestedJson;
    public string $afterNestedJson;
    public string $beforeNestedYaml;
    public string $afterNestedYaml;

    public function setUp(): void
    {
        parent::setUp();
        $this->expectedPlainJson = file_get_contents(__DIR__ . "/fixtures/expectedPlain");
        $this->expectedStylish = file_get_contents(__DIR__ . "/fixtures/expectedStylish");
        $this->beforeNestedJson = __DIR__ . "/fixtures/beforeNested.json";
        $this->afterNestedJson = __DIR__ . "/fixtures/afterNested.json";
        $this->beforeNestedYaml = __DIR__ . "/fixtures/beforeNested.yaml";
        $this->afterNestedYaml = __DIR__ . "/fixtures/afterNested.yaml";
    }

    public function testGenDiffPlainJson()
    {
        $actualJson = genDiff($this->beforeNestedJson, $this->afterNestedJson, "plain");
        $this->assertEquals($this->expectedPlainJson, $actualJson);
    }

    public function testGenDiffStylishJson()
    {
        $actualJson = genDiff($this->beforeNestedJson, $this->afterNestedJson, "stylish");
        $this->assertEquals($this->expectedStylish, $actualJson);
    }

    public function testGenDiffStylishYaml()
    {
        $actualJson = genDiff($this->beforeNestedYaml, $this->afterNestedYaml, "stylish");
        $this->assertEquals($this->expectedStylish, $actualJson);
    }

    public function testGenDiffPlainYaml()
    {
        $actualYaml = genDiff($this->beforeNestedYaml, $this->afterNestedYaml, "plain");
        $this->assertEquals($this->expectedPlainJson, $actualYaml);
    }
}
