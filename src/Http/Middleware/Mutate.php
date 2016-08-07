<?php

namespace Stratedge\Regulator\Http\Middleware;

use Closure;
use Stratedge\Regulator\Mutators\Mutator as AbstractMutator;

class Mutate
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $mutator = $response->getOriginalContent();

        if ($mutator instanceof AbstractMutator == false) {
            return $response;
        }

        $mutation = $mutator->mutate();

        return response()->json(
            $mutation->body(),
            $mutation->status(),
            $mutation->headers(),
            JSON_PRETTY_PRINT
        );
    }
}
