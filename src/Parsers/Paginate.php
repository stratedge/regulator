<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Paginate extends Parser
{
    public function parse(Regulation $regulation)
    {
        $per_page = 25;

        if ($regulation->request()->has("per_page")) {
            if (is_numeric($regulation->request()->per_page)) {
                $per_page = $regulation->request()->per_page;
            }
        }

        $regulation->source($regulation->source()->paginate($per_page));

        return $regulation;
    }
}
