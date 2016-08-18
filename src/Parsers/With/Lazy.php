<?php

namespace Stratedge\Regulator\Parsers\With;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Lazy extends Parser
{
    public function parse(Regulation $regulation)
    {
        if ($regulation->request()->has("with")) {
            $withs = [];

            foreach (explode(",", $regulation->request()->with) as $with) {
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
                $regulation->source()->load([$key => function ($query) use ($value) {
                    $query->with($value);
                }]);
            }
        }

        return $regulation;
    }
}
