<?php

namespace Stratedge\Regulator\Parsers\Headers;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Count extends Parser
{
    public function parse(Regulation $regulation)
    {
        $regulation->addHeaders("X-Count", $regulation->source()->count());

        return $regulation;
    }
}
