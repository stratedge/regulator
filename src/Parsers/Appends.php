<?php

namespace Stratedge\Regulator\Parsers;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Appends extends Parser
{
    public function parse(Regulation $regulation)
    {
        $appends = [];

        if ($regulation->request()->has("fields")) {
            $appends["fields"] = $regulation->request()->fields;
        }

        if ($regulation->request()->has("with")) {
            $appends["with"] = $regulation->request()->with;
        }

        if ($regulation->request()->has("per_page")) {
            $appends["per_page"] = $regulation->request()->per_page;
        }

        if ($regulation->request()->has("sort")) {
            $appends["sort"] = $regulation->request()->sort;
        }

        $regulation->source($regulation->source()->appends($appends));

        return $regulation;
    }
}
