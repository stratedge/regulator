<?php

namespace Tests\Regulators\Regulator;

use Tests\Regulators\Regulator\TestCase;

class GetRequestTest extends TestCase
{
    public function testReturnsRequest()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator($request);

        $this->assertSame($request, $regulator->getRequest());
    }
}
