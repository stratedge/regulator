<?php

namespace Tests\Regulators\Regulator;

use InvalidArgumentException;
use Tests\Regulators\Regulator\TestCase;

class AddParsersTest extends TestCase
{
    public function testReturnsSelf()
    {
        $regulator = $this->getRegulator();

        $parser = $this->getParser();

        $this->assertSame($regulator, $regulator->addParsers($parser));
    }


    public function testInvalidInputThrowsException()
    {
        $this->setExpectedException(InvalidArgumentException::class);

        $regulator = $this->getRegulator();

        $regulator->addParsers(1);
    }


    //**************************************************************************
    // PASSING ARRAY
    //**************************************************************************

    public function testArrayOfParsersAppendsParsersToParserProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();

        $regulator->setParsers($parser1);

        $parser2 = $this->getParser();
        $parser3 = $this->getParser();

        $regulator->addParsers([$parser2, $parser3]);

        $this->assertSame([$parser1, $parser2, $parser3], $regulator->getParsers());
    }


    public function testArrayOfStringsAppendsParsersToParserProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();

        $regulator->setParsers($parser1);

        $parser2 = $this->getParser();
        $parser3 = $this->getParser();

        $regulator->addParsers([get_class($parser2), get_class($parser3)]);

        $this->assertEquals([$parser1, $parser2, $parser3], $regulator->getParsers());
    }


    //**************************************************************************
    // PASSING PARSER(S)
    //**************************************************************************

    public function testParserAppendsToParserProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();

        $regulator->setParsers($parser1);

        $parser2 = $this->getParser();

        $regulator->addParsers($parser2);

        $this->assertSame([$parser1, $parser2], $regulator->getParsers());
    }


    public function testMultipleParsersAppendToParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();

        $regulator->setParsers($parser1);

        $parser2 = $this->getParser();
        $parser3 = $this->getParser();

        $regulator->addParsers($parser2, $parser3);

        $this->assertSame([$parser1, $parser2, $parser3], $regulator->getParsers());
    }


    //**************************************************************************
    // PASSING STRING(S)
    //**************************************************************************

    public function testStringAppendsParserToParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();

        $regulator->setParsers($parser1);

        $parser2 = $this->getParser();

        $regulator->addParsers(get_class($parser2));

        $this->assertEquals([$parser1, $parser2], $regulator->getParsers());
    }


    public function testMutlipleStringsAppendParsersToParsersProperty()
    {
        $regulator = $this->getRegulator();

        $parser1 = $this->getParser();

        $regulator->setParsers($parser1);

        $parser2 = $this->getParser();
        $parser3 = $this->getParser();

        $regulator->addParsers(get_class($parser2), get_class($parser3));

        $this->assertEquals([$parser1, $parser2, $parser3], $regulator->getParsers());
    }
}
