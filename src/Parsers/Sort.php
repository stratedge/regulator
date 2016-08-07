<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Sort extends Parser
{
    public function parse(Mutation $mutation)
    {
        if ($mutation->request()->has("sort")) {
            $fields = explode(",", $mutation->request()->sort);

            foreach ($fields as $field) {
                if (starts_with($field, "-")) {
                    $dir = "desc";
                    $field = substr($field, 1);
                } else {
                    $dir = "asc";
                }

                $mutation->node($mutation->node()->orderBy($field, $dir));
            }
        }

        return $mutation;
    }
}
