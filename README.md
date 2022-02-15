**Project "Difference calculator"**

This script calculates differences between configuration files.

Utility features:

Support for different formats: json, yaml.
Report generation: stylish (by default), json, plain.

### Hexlet tests and linter status:
[![Actions Status](https://github.com/YanaKramareva/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/YanaKramareva/php-project-lvl2/actions)
<a href="https://codeclimate.com/github/YanaKramareva/php-project-lvl2/maintainability"><img src="https://api.codeclimate.com/v1/badges/82facc7880f6f8be7c76/maintainability" /></a>
<a href="https://codeclimate.com/github/YanaKramareva/php-project-lvl2/test_coverage"><img src="https://api.codeclimate.com/v1/badges/82facc7880f6f8be7c76/test_coverage" /></a>
[![PHP CI](https://github.com/YanaKramareva/php-project-lvl2/actions/workflows/workflow.yml/badge.svg)](https://github.com/YanaKramareva/php-project-lvl2/actions/workflows/workflow.yml)

### Usage example: ###
**CLI application:**

Help output:
gendiff -h

Start script:

1. php gendiff filepath1.json filepath2.json
2. php gendiff filepath1.yaml filepath2.yaml
3. php gendiff --format plain filepath1.yaml filepath2.yaml
4. php gendiff --format json filepath1.json filepath2.json

### Library: ###

use function Differ\Differ\genDiff;

genDiff($pathToFile1, $pathTofile2, $format = 'stylish');

### Installation: ###

To install globally run the command:

$ composer global require YanaKramareva/php-project-lvl2

To install into the project as a library run the command:

$ composer require YanaKramareva/php-project-lvl2

For development require: 
PHP >=8.0, Composer 

### Commands: ###

#### $ make install #### 
#### $ make lint ####
#### $ make test ####
#### $ make coverage ####

**Asciinema:** 

[![asciicast](https://asciinema.org/a/Pf5PQcwKeDjqj7hb5e4AO5YKW.svg)](https://asciinema.org/a/Pf5PQcwKeDjqj7hb5e4AO5YKW)
[![asciicast](https://asciinema.org/a/7kaWuyrkCirsH21Iw888CcBsy.svg)](https://asciinema.org/a/7kaWuyrkCirsH21Iw888CcBsy)
[![asciicast](https://asciinema.org/a/mWbK7t0RRFuRE2E2bo9ws8XcV.svg)](https://asciinema.org/a/mWbK7t0RRFuRE2E2bo9ws8XcV)
