<?php

namespace Stratedge\Regulator\Filters;

use Stratedge\Regulator\Mutation;

abstract class Filter
{
    abstract public function filter(Mutation $mutation);
}
