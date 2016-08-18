<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Sort extends Parser
{
    public function parse(Regulation $regulation)
    {
        if ($regulation->request()->has("sort")) {
            $fields = explode(",", $regulation->request()->sort);

            foreach ($fields as $field) {
                if (starts_with($field, "-")) {
                    $dir = "desc";
                    $field = substr($field, 1);
                } else {
                    $dir = "asc";
                }

                $regulation->source($regulation->source()->orderBy($field, $dir));
            }
        }

        return $regulation;
    }
}
