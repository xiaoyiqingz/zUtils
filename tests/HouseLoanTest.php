<?php
//require( dirname(__DIR__) . '/vendor/autoload.php');

use Zutils\HouseLoan;

class Escape2013Test extends PHPUnit_Framework_TestCase
{
    public function test1()
    {
        $test1 = new HouseLoan(1, 600000, 20);
        $res = $test1->returnPerMonth();

        $this->assertEquals(3926.66, $res);
    }
}
