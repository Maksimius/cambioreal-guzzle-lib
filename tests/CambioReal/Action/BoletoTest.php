<?php

class BoletoTest extends TestCase
{
    public function testValidateId()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'id' was not supplied.");
        \CambioReal\CambioReal::boleto(array());
    }

    public function testValidateToken()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'token' was not supplied.");
        \CambioReal\CambioReal::boleto(array('id' => 1));
    }

    public function testRequest()
    {
        $id = rand(1, 300);
        $token = md5(time());
        $request = \CambioReal\CambioReal::boleto(array('id' => $id, 'token' => $token));

        $this->assertEquals('GET', $request['method']);
        $this->assertEquals('http://cambioreal.dev/service/v1/checkout/boleto', $request['action']);
        $this->assertEquals(false, $request['decode']);
        $this->assertEquals($id, $request['params']['id']);
        $this->assertEquals($token, $request['params']['token']);
    }
}