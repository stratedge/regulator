<?php

namespace Stratedge\Regulator\Parsers\Headers;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Count extends Parser
{
    public function parse(Mutation $mutation)
    {
        $mutation->addHeaders("X-Count", $mutation->node()->count());

        return $mutation;
    }
}
