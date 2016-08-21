<?php

namespace Tests\Regulators\Regulator;

use Tests\Regulators\Regulator\TestCase;

class SetRequestTest extends TestCase
{
    public function testReturnsSelf()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator();

        $this->assertSame($regulator, $regulator->setRequest($request));
    }


    public function testSetsRequest()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator();

        $this->assertNotSame($request, $regulator->getRequest());

        $regulator->setRequest($request);

        $this->assertSame($request, $regulator->getRequest());
    }
}
