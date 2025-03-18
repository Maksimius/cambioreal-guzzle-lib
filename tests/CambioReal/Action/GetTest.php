<?php

class GetTest extends TestCase
{
    public function testValidateIdRequired()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'id' was not supplied.");
        \CambioReal\CambioReal::get([]);
    }

    public function testValidateTokenRequired()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'token' was not supplied.");
        \CambioReal\CambioReal::get(['id' => 123123]);
    }

    public function testRequest()
    {
        $id = 1312323;
        $token = md5(time());
        $request = \CambioReal\CambioReal::get(['id' => $id, 'token' => $token]);

        $this->assertEquals('GET', $request['method']);
        $this->assertEquals('https://sandbox.cambioreal.com/service/v1/checkout/get', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($id, $request['params']['id']);
        $this->assertEquals($token, $request['params']['token']);
    }
}
