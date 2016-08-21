<?php

namespace Tests\Regulators\Regulator;

use ErrorException;
use Illuminate\Http\Request;
use Tests\Regulators\Regulator\TestCase;

class RequestTest extends TestCase
{
    public function testPassNothingReturnsRequest()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator($request);

        $this->assertSame($request, $regulator->request());
    }


    public function testPassNullReturnsRequest()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator($request);

        $this->assertSame($request, $regulator->request(null));
    }


    public function testPassRequestReturnsSelf()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator();

        $this->assertSame($regulator, $regulator->request($request));
    }


    public function testPassRequestSetsRequest()
    {
        $request = $this->getRequest();

        $regulator = $this->getRegulator();

        $regulator->request($request);

        $this->assertAttributeSame($request, "request", $regulator);
    }


    public function testPassInvalidValueThrowsException()
    {
        $this->setExpectedException(ErrorException::class);

        $regulator = $this->getRegulator();

        $regulator->request("test");
    }
}
