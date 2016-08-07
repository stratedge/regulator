<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Mutation;

abstract class Parser
{
    abstract public function parse(Mutation $mutation);
}
