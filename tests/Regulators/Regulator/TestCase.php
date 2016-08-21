<?php

namespace Tests\Regulators\Regulator;

use Illuminate\Http\Request;
use Stratedge\Regulator\Parsers\Parser;
use Stratedge\Regulator\Regulators\Regulator;
use Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getRegulator(Request $request = null)
    {
        if (is_null($request)) {
            $request = $this->getRequest();
        }

        return $this->getMockForAbstractClass(Regulator::class, [$request]);
    }


    protected function getRequest($return_builder = false)
    {
        $request = $this->getMockBuilder(Request::class);

        if ($return_builder) {
            return $request;
        }

        return $request->getMock();
    }

    protected function getParser()
    {
        return $this->getMockForAbstractClass(Parser::class);
    }
}
