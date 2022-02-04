<?php

namespace Differ\Formatters\Json;

function formatJson(array $ast): string
{
    return json_encode($ast);
}

/*
 * Line   src/Cli.php
app_1  |  ------ --------------------------------------
app_1  |   30     Enforce that an expression gets used
app_1  |  ------ --------------------------------------
app_1  |
app_1  |  ------ ----------------------------------------------------------------------
app_1  |   Line   src/Differ.php
app_1  |  ------ ----------------------------------------------------------------------
app_1  |   12     Only booleans are allowed in a negated boolean, string|false given.
app_1  |   25     Enforce that an expression gets used
app_1  |   25     Parameter #1 $array of function ksort expects array, array|null
app_1  |          given.
app_1  |   25     The use of function 'ksort' is not allowed as it might be a mutating
app_1  |          function
app_1  |   27     Enforce that an expression gets used
app_1  |   27     Parameter #1 $array of function ksort expects array, array|null
app_1  |          given.
app_1  |   27     The use of function 'ksort' is not allowed as it might be a mutating
app_1  |          function
app_1  |   29     Parameter #1 $beforeParsedContent of function Differ\Ast\makeAst
app_1  |          expects array, array|null given.
app_1  |   29     Parameter #2 $afterParsedContent of function Differ\Ast\makeAst
app_1  |          expects array, array|null given.
app_1  |   30     Trying to invoke string but it might not be a callable.
app_1  |  ------ ----------------------------------------------------------------------
app_1  |
app_1  |  ------ ---------------------------------------------------------------------
app_1  |   Line   src/Formatters/Plain.php
app_1  |  ------ ---------------------------------------------------------------------
app_1  |   42     Function Differ\Formatters\Plain\formatValue() has parameter $value
app_1  |          with no type specified.
app_1  |  ------ ---------------------------------------------------------------------
app_1  |
app_1  |  ------ -----------------------------------------------------------------------
app_1  |   Line   src/Formatters/Stylish.php
app_1  |  ------ -----------------------------------------------------------------------
app_1  |   42     Function Differ\Formatters\Stylish\formatValue() has parameter $value
app_1  |          with no type specified.
app_1  |   51     Should not use of mutating operators
app_1  |   58     Function Differ\Formatters\Stylish\toString() has parameter $value
app_1  |          with no type specified.
app_1  |  ------ -----------------------------------------------------------------------
app_1  |
app_1  |  ------ ---------------------------------------------------------------------
app_1  |   Line   src/MakeAst.php
app_1  |  ------ ---------------------------------------------------------------------
app_1  |   10     Enforce that an expression gets used
app_1  |   10     The use of function 'sort' is not allowed as it might be a mutating
app_1  |          function
app_1  |   14     Function Differ\Ast\makeItemOfAst() has parameter $key with no type
app_1  |          specified.
app_1  |  ------ ---------------------------------------------------------------------
app_1  |
app_1  |
Error: p_1  |  [ERROR] Found 18 errors
app_1  |
app_1  |
app_1  | Script
 */
