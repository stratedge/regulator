<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Regulation;

abstract class Parser
{
    abstract public function parse(Regulation $regulation);
}
