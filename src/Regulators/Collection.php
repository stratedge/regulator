<?php

namespace Stratedge\Regulator\Regulators;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Regulators\Regulator;

class Collection extends Regulator
{
    public function regulate()
    {
        $regulation = $this->makeRegulation();

        $regulation = $this->filter($regulation);
        $regulation = $this->parse($regulation);

        return $regulation;
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
