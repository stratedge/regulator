<?php

namespace Stratedge\Regulator\Parsers\Body;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Paginated extends Parser
{
    public function parse(Mutation $mutation)
    {
        $mutation->body($mutation->node()->items());

        return $mutation;
    }
}
