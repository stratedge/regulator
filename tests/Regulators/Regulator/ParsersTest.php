<?php

namespace Tests\Regulators\Regulator;

use Tests\Regulators\Regulator\TestCase;

class ParsersTest extends TestCase
{
    //**************************************************************************
    // PASSING NOTHING/NULL
    //**************************************************************************

    public function testPassingNothingReturnsParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parsers = [
            $this->getParser()
        ];

        $regulator->setParsers($parsers);

        $this->assertSame($parsers, $regulator->parsers());
    }


    public function testPassingNullReturnsParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parsers = [
            $this->getParser()
        ];

        $regulator->setParsers($parsers);

        $this->assertSame($parsers, $regulator->parsers(null));
    }


    //**************************************************************************
    // PASSING ARRAY
    //**************************************************************************

    public function testPassingArrayOfParsersSetsParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parsers = [
            $this->getParser()
        ];

        $regulator->parsers($parsers);

        $this->assertSame($parsers, $regulator->getParsers());
    }


    public function testPassingArrayOfParsersOverwritesParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parsers = [
            $this->getParser()
        ];

        //Initial set
        $regulator->setParsers($parsers);

        $parsers = [
            $this->getParser()
        ];

        //Overwrite
        $regulator->parsers($parsers);

        $this->assertSame($parsers, $regulator->getParsers());
    }


    public function testPassingArrayOfParsersReturnsSelf()
    {
        $regulator = $this->getRegulator();

        $parsers = [
            $this->getParser()
        ];

        $this->assertSame($regulator, $regulator->parsers($parsers));
    }


    //**************************************************************************
    // PASSING PARSER(S)
    //**************************************************************************

    public function testPassingParserSetsParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser = $this->getParser();

        $regulator->parsers($parser);

        $this->assertSame([$parser], $regulator->getParsers());
    }


    public function testPassingParserOverwritesParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser = $this->getParser();

        //Initial set
        $regulator->setParsers($parser);

        $parser = $this->getParser();

        //Overwrite
        $regulator->parsers($parser);

        $this->assertSame([$parser], $regulator->getParsers());
    }


    public function testPassingParserReturnsSelf()
    {
        $regulator = $this->getRegulator();

        $parser = $this->getParser();

        $this->assertSame($regulator, $regulator->parsers($parser));
    }


    public function testPassingParsersSetsParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();
        $parser2 = $this->getParser();

        $regulator->parsers($parser1, $parser2);

        $this->assertSame([$parser1, $parser2], $regulator->getParsers());
    }


    public function testPassingParsersOverwritesParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();
        $parser2 = $this->getParser();

        //Initial set
        $regulator->setParsers($parser1, $parser2);

        $parser1 = $this->getParser();
        $parser2 = $this->getParser();

        //Overwrite
        $regulator->parsers($parser1, $parser2);

        $this->assertSame([$parser1, $parser2], $regulator->getParsers());
    }


    public function testPassingParsersReturnsSelf()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();
        $parser2 = $this->getParser();

        $this->assertSame($regulator, $regulator->parsers($parser1, $parser2));
    }
}
