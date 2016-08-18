<?php

namespace Stratedge\Regulator\Filters;

use Stratedge\Regulator\Regulation;

abstract class Filter
{
    abstract public function filter(Regulation $regulation);
}
