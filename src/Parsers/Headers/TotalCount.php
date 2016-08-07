<?php

namespace Stratedge\Regulator\Parsers\Headers;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class TotalCount extends Parser
{
    public function parse(Mutation $mutation)
    {
        $mutation->addHeaders("X-Total-Count", $mutation->node()->total());

        return $mutation;
    }
}
