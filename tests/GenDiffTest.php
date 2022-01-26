<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{

    public function setUp(): void
    {
        $this->before = __DIR__ . "/fixtures/before.json";
        $this->after = __DIR__ . "/fixtures/after.json";
        $this->expected = __DIR__ . "/fixtures/PlainExpected";

        $this->beforeNotPlain = __DIR__ . "/fixtures/beforeNotPlain.json";
        $this->afterNotPlain = __DIR__ . "/fixtures/afterNotPlain.json";
        $this->expectedStylish = __DIR__ . "/fixtures/ExpectedStylish";

        $this->beforeNotPlainYaml = __DIR__ . "/fixtures/beforeNotPlain.yaml";
        $this->afterNotPlainYaml = __DIR__ . "/fixtures/afterNotPlain.yaml";
        
        $this->expectedJson = __DIR__ . "/fixtures/expected.json";
        $this->expectedPlain = __DIR__ . "/fixtures/ExpectedPlain";
    }
      
  public function testGenDiff1()
    {
        
        $this->assertStringEqualsFile(
            $this->expected,
            genDiff($this->before, $this->after));
    }
    public function testGenDiff2()
    {

        $this->assertStringEqualsFile(
            $this->expectedStylish,
            genDiff($this->beforeNotPlain, $this->afterNotPlain));
    }

    public function testGenDiff3()
    {
        $this->assertStringEqualsFile(
            $this->expectedStylish,
            genDiff($this->beforeNotPlainYaml, $this->afterNotPlainYaml));
    }


    public function testGenDiff4()
    {
        $this->assertStringEqualsFile(
            $this->expectedPlain,
            genDiff($this->beforeNotPlain, $this->afterNotPlain, 'plain'));
    }

}