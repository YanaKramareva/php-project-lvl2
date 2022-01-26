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
        $this->expectedNotPlain = __DIR__ . "/fixtures/NotPlainExpected";

        $this->beforeNotPlainYaml = __DIR__ . "/fixtures/beforeNotPlain.yaml";
        $this->afterNotPlainYaml = __DIR__ . "/fixtures/afterNotPlain.yaml";
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
            $this->expectedNotPlain,
            genDiff($this->beforeNotPlain, $this->afterNotPlain));
    }

    public function testGenDiff3()
    {
        $this->assertStringEqualsFile(
            $this->expectedNotPlain,
            genDiff($this->beforeNotPlainYaml, $this->afterNotPlainYaml));
    }

}