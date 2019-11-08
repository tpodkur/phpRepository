<?php

namespace Roowix\Test\Podkur;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Roowix\Podkur\Api;
use Roowix\Podkur\DB\DB;
use Roowix\Podkur\Response\ResponseWriter;

class ApiTest extends TestCase
{
    /** @var string  */
    private $uri;
    /** @var string  */
    private $method;
    /** @var ResponseWriter|MockObject  */
    private $mockResponse;
    /** @var DB|MockObject  */
    private $mockConnect;

    public function setUp(): void
    {
        $this->uri = 'localhost/api/1';
        $this->mockResponse = $this->getMockBuilder(ResponseWriter::class)->disableOriginalConstructor()->getMock();
        $this->mockConnect = $this->getMockBuilder(DB::class)->disableOriginalConstructor()->getMock();
    }

    public function testResponseOfGetAction()
    {
        // arrange
        $this->method = 'GET';
        $this->mockConnect->method('takeAll')
            ->willReturn(["firstname" => 'test', "lastname" => 'test', "id" => 0]);
        $api = new Api($this->mockConnect);

        // act
        $res = $api->run($this->uri, $this->method, $this->mockResponse);

        // assert
        $this->assertNotEmpty($res);
        $this->assertEquals($res, '{"firstname":"test","lastname":"test","id":0}');
    }

    public function testResponseOfCreateAction()
    {
        // arrange
        $this->method = 'POST';
        $_POST = ["id" => 'test', "lastname" => 'test'];
        $this->mockConnect->method('insert')->willReturn(["firstname" => 'test', "lastname" => 'test', "id" => 0]);

        $api = new Api($this->mockConnect);

        // act
        $res = $api->run($this->uri, $this->method, $this->mockResponse);

        // assert
        $this->assertNotEmpty($res);
        $this->assertEquals($res, '{"firstname":"test","lastname":"test","id":0}');
    }

    public function testDeleteRunWithCorrectArgument()
    {
        // arrange
        $this->method = 'DELETE';
        $api = new Api($this->mockConnect);

        $this->mockConnect->method('delete')->with(["id" => 1])->willReturn(["id" => 1]);

        // act
        $res = $api->run($this->uri, $this->method, $this->mockResponse);

        // assert
        $this->assertEquals($res, '{"id":1}');
    }

    public function testRunUpdateAction()
    {
        // arrange
        $this->method = 'PUT';
        $_POST = ["firstName" => 'testName', "lastName" => 'testName', "id" => 1];
        $api = new Api($this->mockConnect);

        $this->mockConnect->method('update')->with($_POST, ["id" => 1])->willReturn(["id" => 1]);

        // act
        $res = $api->run($this->uri, $this->method, $this->mockResponse);

        // assert
        $this->assertNotEmpty($res);
    }

    public function testRunReturnNull()
    {
        // arrange
        //$this->method = '0';
        $api = new Api($this->mockConnect);

        // act
        $res = $api->run();

        // assert
        $this->assertNull($res);
    }
}
