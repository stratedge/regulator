<?php

namespace Stratedge\Regulator\Parsers\Headers;

use Stratedge\Regulator\Mutation;
use Stratedge\Regulator\Parsers\Parser;

class Link extends Parser
{
    public function parse(Mutation $mutation)
    {
        $links = [];

        if ($mutation->node()->count()) {
            if ($mutation->node()->currentPage() !== $mutation->node()->lastPage()) {
                $links[] = '<' . $mutation->node()->nextPageUrl() . '>; rel="next"';
                $links[] = '<'. $mutation->node()->url($mutation->node()->lastPage()) . '>; rel="last"';
            }

            if ($mutation->node()->currentPage() !== 1) {
                $links[] = '<' . $mutation->node()->url(1) . '>; rel="first"';
                $links[] = '<' . $mutation->node()->previousPageUrl() . '>; rel="prev"';
            }
        }

        if (!empty($links)) {
            $link = implode(", ", $links);
            $mutation->addHeaders("Link", $link);
        }

        return $mutation;
    }
}
