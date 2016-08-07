<?php

namespace Stratedge\Regulator\Mutators;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Mutators\Mutator;

class Node extends Mutator
{
    public function mutate()
    {
        $mutation = $this->makeMutation();

        $mutation = $this->parse($mutation);

        return $mutation;
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
