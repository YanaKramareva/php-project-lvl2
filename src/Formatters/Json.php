<?php

namespace Differ\Formatters\Json;

function formatJson($ast)
{
    return json_encode($ast);
}
