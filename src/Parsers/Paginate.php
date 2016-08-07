<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Paginate extends Parser
{
    public function parse(Mutation $mutation)
    {
        $per_page = 25;

        if ($mutation->request()->has("per_page")) {
            if (is_numeric($mutation->request()->per_page)) {
                $per_page = $mutation->request()->per_page;
            }
        }

        $mutation->node($mutation->node()->paginate($per_page));

        return $mutation;
    }
}
