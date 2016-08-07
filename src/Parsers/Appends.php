<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Appends extends Parser
{
    public function parse(Mutation $mutation)
    {
        $appends = [];

        if ($mutation->request()->has("fields")) {
            $appends["fields"] = $mutation->request()->fields;
        }

        if ($mutation->request()->has("with")) {
            $appends["with"] = $mutation->request()->with;
        }

        if ($mutation->request()->has("per_page")) {
            $appends["per_page"] = $mutation->request()->per_page;
        }

        if ($mutation->request()->has("sort")) {
            $appends["sort"] = $mutation->request()->sort;
        }

        $mutation->node($mutation->node()->appends($appends));

        return $mutation;
    }
}
