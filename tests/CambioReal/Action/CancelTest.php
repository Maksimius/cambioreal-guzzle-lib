<?php

/**
 * The cancel action class.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class CancelTest extends TestCase
{
    public function testValidateId()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'id' was not supplied.");
        \CambioReal\CambioReal::cancel([]);
    }

    public function testValidateToken()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'token' was not supplied.");
        \CambioReal\CambioReal::cancel(['id' => '123213']);
    }

    public function testCancelRequestIsCorrect()
    {
        $id = 123123123;
        $token = md5(time());
        $request = \CambioReal\CambioReal::cancel(['id' => $id, 'token' => $token]);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://sandbox.cambioreal.com/service/v1/checkout/cancel', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($id, $request['params']['id'], $id);
        $this->assertEquals($token, $request['params']['token'], $token);
    }
}
