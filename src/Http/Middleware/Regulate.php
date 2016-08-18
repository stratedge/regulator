<?php

namespace Stratedge\Regulator\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Stratedge\Regulator\Regulators\Regulator;

class Regulate
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof Response === false) {
            return $response;
        }

        $regulator = $response->getOriginalContent();

        if ($regulator instanceof Regulator === false) {
            return $response;
        }

        $regulation = $regulator->regulate();

        return response()->json(
            $regulation->body(),
            $regulation->status(),
            $regulation->headers(),
            JSON_PRETTY_PRINT
        );
    }
}
