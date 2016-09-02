<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Stratedge\Wye\Wye;

class TestCase extends BaseTestCase
{
    public function setUp()
    {
        Wye::reset();
    }
}
