<?php

namespace Stratedge\Regulator\Parsers\Body;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Node extends Parser
{
    public function parse(Regulation $regulation)
    {
        $regulation->body($regulation->source());

        return $regulation;
    }
}
