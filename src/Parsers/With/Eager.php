<?php

namespace Stratedge\Regulator\Parsers\With;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Eager extends Parser
{
    public function parse(Mutation $mutation)
    {
        if ($mutation->request()->has('with')) {
            $withs = explode(",", $mutation->request()->with);

            $mutation->node($mutation->node()->with($withs));
        }

        return $mutation;
    }
}
