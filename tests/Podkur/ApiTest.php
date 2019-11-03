<?php

namespace Roowix\Test\Podkur;

use PHPUnit\Framework\TestCase;
use Roowix\Podkur\Api;
use Roowix\Podkur\DataBaseConnect;
use Roowix\Podkur\ResponseWriter;

class ApiTest extends TestCase
{
    public function testRunCallGetAction()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'GET';
        $tableName = 'students';

        $mockResponse = $this->getMockBuilder(ResponseWriter::class)->getMock();
        $mockConnect = $this->getMockBuilder(DataBaseConnect::class)->getMock();

        $api = new Api($uri, $method, $tableName, $mockConnect, $mockResponse);

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
        $_POST =  array("id" => 'test', "lastname" => 'test');

        $mockResponse = $this->getMockBuilder(ResponseWriter::class)->getMock();
        $mockConnect = $this->getMockBuilder(DataBaseConnect::class)->getMock();

        $api = new Api($uri, $method, $tableName, $mockConnect, $mockResponse);

        // act
        $res = $api->run();
        echo $res;

        // assert
        $this->assertNotEmpty($res);
    }

    public function testRunDeleteAction()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'DELETE';
        $tableName = 'students';

        $mockResponse = $this->getMockBuilder(ResponseWriter::class)->getMock();
        $mockConnect = $this->getMockBuilder(DataBaseConnect::class)->getMock();

        $api = new Api($uri, $method, $tableName, $mockConnect, $mockResponse);

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
        $_POST = array("id" => 0);

        $mockResponse = $this->getMockBuilder(ResponseWriter::class)->getMock();
        $mockConnect = $this->getMockBuilder(DataBaseConnect::class)->getMock();

        $api = new Api($uri, $method, $tableName, $mockConnect, $mockResponse);

        // act
        $res = $api->run();

        // assert
        $this->assertNotEmpty($res);
    }

    public function testCorrectData()
    {
        // arrange
        $uri = 'localhost/api/1';
        $method = 'GET';
        $tableName = 'students';

        $mockResponse = $this->getMockBuilder(ResponseWriter::class)->getMock();

        $mockConnect = $this->getMockBuilder(DataBaseConnect::class)->getMock();
        $mockConnect->method('takeAll')->willReturn(array("firstname" => 'test', "lastname" => 'test', "id" => 0));

        $api = new Api($uri, $method, $tableName, $mockConnect, $mockResponse);

        // act
        $res = $api->run();

        //assert
        $this->assertContains($res, ['test', 'test', 0]);
    }
}
