<?php

class RegisterAccountTest extends TestCase
{
    protected $params;

    public function setUp(): void
    {
        parent::setUp();

        $this->params = [
            'email' => 'teste@cambioreal.com',
            'cpf' => '693.891.104-59',
            'nome' => 'Teste CambioReal',
            'data_nasc' => '10/10/1970',
            'phone1' => '+55 (45) 9999-9999',
            'endereco' => 'Av. Tiradentes',
            'cidade' => 'Itaipulândia',
            'estado' => 'PR',
            'zip' => '85880-000',
            'district' => 'Centro',
            'number' => '2045',
        ];
    }

    public function testValidateEmail()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'email' was not supplied.");
        unset($this->params['email']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateCpf()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'cpf' was not supplied.");
        unset($this->params['cpf']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateNome()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'nome' was not supplied.");
        unset($this->params['nome']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateDataNasc()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'data_nasc' was not supplied.");
        unset($this->params['data_nasc']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidatePhone1()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'phone1' was not supplied.");
        unset($this->params['phone1']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateEndereco()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'endereco' was not supplied.");
        unset($this->params['endereco']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateCidade()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'cidade' was not supplied.");
        unset($this->params['cidade']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateEstado()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'estado' was not supplied.");
        unset($this->params['estado']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateZip()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'zip' was not supplied.");
        unset($this->params['zip']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateDistrict()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'district' was not supplied.");
        unset($this->params['district']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testValidateNumber()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'number' was not supplied.");
        unset($this->params['number']);
        \CambioReal\CambioReal::registerAccount($this->params);
    }

    public function testRequest()
    {
        $request = \CambioReal\CambioReal::registerAccount($this->params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://sandbox.cambioreal.com/service/v1/checkout/register-account', $request['action']);
        $this->assertEquals(true, $request['decode']);

        foreach ($this->params as $key => $value) {
            $this->assertEquals($value, $request['params'][$key]);
        }
    }
}
