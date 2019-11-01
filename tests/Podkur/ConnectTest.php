<?php

namespace Roowix\Test\Podkur;

use PHPUnit\Framework\TestCase;
use Roowix\Podkur\Connect;

class ConnectTest extends TestCase
{
    public function testItCanGet()
    {
        // arrange
        $str = "host=localhost port=5432 dbname=postgres user=postgres password=iebdkst";
        $conn = new Connect($str);
//        $mock = $this->getMockBuilder();
//        $mock->method


        // act
        $result = $conn->getConnect();

        // assert

        $this->assertNotEmpty($result);
    }
}