<?php

namespace Stratedge\Regulator\Parsers\With;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Lazy extends Parser
{
    public function parse(Mutation $mutation)
    {
        if ($mutation->request()->has("with")) {
            $withs = [];

            foreach (explode(",", $mutation->request()->with) as $with) {
                $parts = explode(".", $with);
                $key = array_shift($parts);
                $value = implode(".", $parts);

                if (!isset($withs[$key])) {
                    $withs[$key] = [];
                }

                if (!empty($value)) {
                    $withs[$key][] = $value;
                }
            }

            foreach ($withs as $key => $value) {
                $mutation->node()->load([$key => function ($query) use ($value) {
                    $query->with($value);
                }]);
            }
        }

        return $mutation;
    }
}
