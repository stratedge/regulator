<?php

namespace Stratedge\Regulator\Parsers\Body;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Node extends Parser
{
    public function parse(Mutation $mutation)
    {
        $mutation->body($mutation->node());

        return $mutation;
    }
}
