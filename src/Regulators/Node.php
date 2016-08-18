<?php

namespace Stratedge\Regulator\Regulators;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Regulators\Regulator;

class Node extends Regulator
{
    public function regulate()
    {
        $regulation = $this->makeRegulation();

        $regulation = $this->parse($regulation);

        return $regulation;
    }


    public function registerParsers()
    {
        $this->parsers([
            \Stratedge\Regulator\Parsers\With\Lazy::class,
            \Stratedge\Regulator\Parsers\LimitFields\Node::class,
            \Stratedge\Regulator\Parsers\Body\Node::class,
        ]);
    }
}
