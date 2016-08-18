<?php

namespace Stratedge\Regulator\Parsers\Headers;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class TotalCount extends Parser
{
    public function parse(Regulation $regulation)
    {
        $regulation->addHeaders("X-Total-Count", $regulation->source()->total());

        return $regulation;
    }
}
