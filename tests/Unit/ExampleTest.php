<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    private $bool = false;
    /**
     * A basic test example.
     *
     * @return void;
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
        $this->bool  = true;
    }
}
