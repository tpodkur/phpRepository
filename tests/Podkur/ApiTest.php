<?php

namespace Roowix\Test\Podkur;

use PHPUnit\Framework\TestCase;
use Roowix\Podkur\Api;
use Roowix\Podkur\DataBaseConnect;

class ApiTest extends TestCase
{
    public function testRunCallGetAction()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'GET';
        $tableName = 'students';
        $mock = $this->getMockBuilder(DataBaseConnect::class)->getMock();
        $api = new Api($uri, $method, $tableName, $mock);

        // act
        $res = $api->run();

        // assert
        $this->assertNotEmpty($res);
    }

    public function testRunCallCreateAction()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'POST';
        $tableName = 'students';
        $mock = $this->getMockBuilder(DataBaseConnect::class)->getMock();
        $mock->method('insert')->willReturn(["firstname" => 'test', "lastname" => 'test']);

        $api = new Api($uri, $method, $tableName, $mock);

        // act
        $res = $api->run();

        // assert
        $this->assertNotEmpty($res);
    }

    public function testRunDeleteAction()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'DELETE';
        $tableName = 'students';
        $mock = $this->getMockBuilder(DataBaseConnect::class)->getMock();
        $api = new Api($uri, $method, $tableName, $mock);

        // act
        $res = $api->run();

        // assert
        $this->assertNotEmpty($res);
    }

    public function testRunCallUpdateAction()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'PUT';
        $tableName = 'students';
        $mock = $this->getMockBuilder(DataBaseConnect::class)->getMock();
        $api = new Api($uri, $method, $tableName, $mock);

        // act
        $res = $api->run();

        // assert
        $this->assertNotEmpty($res);
    }
}
