<?php

namespace Hexlet\Code\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class GenDiffTest extends TestCase
{
    private function getFixturePath($fileName)
    {
        return implode(DIRECTORY_SEPARATOR, [__DIR__, "fixtures", $fileName]);
    }

    /**
     * @dataProvider additionProvider
     */

    public function testGenDiff($expected, $firstPathToFile, $secondPathToFile, $formatName = 'stylish')
    {
        $this->assertEquals($expected, genDiff($firstPathToFile, $secondPathToFile, $formatName));
    }

    public function additionProvider()
    {
        $stylishFormatName = 'stylish';
        $plainFormatName = 'plain';
        $jsonFormatName = 'json';

        $expectedStylish = file_get_contents($this->getFixturePath('expectedStylish'));
        $expectedPlain = file_get_contents($this->getFixturePath('expectedPlain'));
        $expectedJson = file_get_contents($this->getFixturePath('expected.json'));

        $beforeNestedJson = $this->getFixturePath('beforeNested.json');
        $afterNestedJson = $this->getFixturePath('afterNested.json');
        $beforeNestedYaml = $this->getFixturePath('beforeNested.yaml');
        $afterNestedYaml = $this->getFixturePath('afterNested.yaml');

        return [
            [$expectedStylish, $beforeNestedJson, $afterNestedJson],
            [$expectedStylish, $beforeNestedYaml, $afterNestedYaml],
            [$expectedStylish, $beforeNestedJson, $afterNestedJson, $stylishFormatName],
            [$expectedStylish, $beforeNestedYaml, $afterNestedYaml, $stylishFormatName],
            [$expectedPlain, $beforeNestedJson, $afterNestedJson, $plainFormatName],
            [$expectedPlain, $beforeNestedYaml, $afterNestedYaml, $plainFormatName],
            [$expectedJson, $beforeNestedJson, $afterNestedJson, $jsonFormatName],
            [$expectedJson, $beforeNestedYaml, $afterNestedYaml, $jsonFormatName],
        ];
    }
}
