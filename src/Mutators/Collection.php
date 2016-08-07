<?php

namespace Stratedge\Regulator\Mutators;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Mutators\Mutator;

class Collection extends Mutator
{
    public function mutate()
    {
        $mutation = $this->makeMutation();

        $mutation = $this->filter($mutation);
        $mutation = $this->parse($mutation);

        return $mutation;
    }


    public function registerParsers()
    {
        $this->parsers([
            //Pre-pagination
            \Stratedge\Regulator\Parsers\Sort::class,
            \Stratedge\Regulator\Parsers\With\Eager::class,

            //Pagination
            \Stratedge\Regulator\Parsers\Paginate::class,

            //Post-pagination
            \Stratedge\Regulator\Parsers\Appends::class,
            \Stratedge\Regulator\Parsers\LimitFields\Collection::class,
            \Stratedge\Regulator\Parsers\Headers\Link::class,
            \Stratedge\Regulator\Parsers\Headers\Count::class,
            \Stratedge\Regulator\Parsers\Headers\TotalCount::class,
            \Stratedge\Regulator\Parsers\Body\Paginated::class,
        ]);
    }
}
