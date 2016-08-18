<?php

namespace Stratedge\Regulator\Parsers\Headers;

use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Link extends Parser
{
    public function parse(Regulation $regulation)
    {
        $links = [];

        if ($regulation->source()->count()) {
            if ($regulation->source()->currentPage() !== $regulation->source()->lastPage()) {
                $links[] = '<' . $regulation->source()->nextPageUrl() . '>; rel="next"';
                $links[] = '<'. $regulation->source()->url($regulation->source()->lastPage()) . '>; rel="last"';
            }

            if ($regulation->source()->currentPage() !== 1) {
                $links[] = '<' . $regulation->source()->url(1) . '>; rel="first"';
                $links[] = '<' . $regulation->source()->previousPageUrl() . '>; rel="prev"';
            }
        }

        if (!empty($links)) {
            $link = implode(", ", $links);
            $regulation->addHeaders("Link", $link);
        }

        return $regulation;
    }
}
