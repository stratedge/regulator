<?php

namespace Stratedge\Regulator\Parsers\With;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Eager extends Parser
{
    public function parse(Regulation $regulation)
    {
        if ($regulation->request()->has('with')) {
            $withs = explode(",", $regulation->request()->with);

            $regulation->source($regulation->source()->with($withs));
        }

        return $regulation;
    }
}
