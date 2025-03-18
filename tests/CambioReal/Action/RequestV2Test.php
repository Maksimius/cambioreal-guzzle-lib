<?php

/**
 * Request action for api.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class RequestV2Test extends TestCase
{
    protected $params;

    public function setUp(): void
    {
        parent::setUp();

        $size = 16;
        $bytes = random_bytes($size);
        $order_id = substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);

        $this->params = [
            'client' => [
                'name'       => 'John Maxxel',
                'email'      => 'john@max.com',
                'document'   => '000.000.000-00',
                'birth_date' => (date('Y') - 18) . '-01-01',
                'phone'      => '+55 11 99999-9999',
                'ip'         => '127.0.0.1',
                'address'    => [
                    'state'    => 'SP',
                    'city'     => 'São Paulo',
                    'zip_code' => '27275-595',
                    'district' => 'Jardim América',
                    'street'  => 'Avenida Brasil',
                    'number'   => '1120',
                ],
            ],
            'order_id'       => $order_id,
            'currency'       => 'USD',
            'amount'         => 130.00,
            'payment_method' => 'pix',
            'duplicate'      => false,
            'due_date'       => null,
            'products'       => [
                [
                    'descricao'  => 'Laptop i7',
                    'base_value' => 800.00,
                    'valor'      => 1600.00,
                    'qty'        => 2,
                    'ref'        => 1,
                ],
                [
                    'descricao'  => 'Frete',
                    'base_value' => 5.00,
                    'valor'      => 5.00,
                    'ref'        => 'São Paulo - SP',
                ],
            ],
        ];
    }

    public function testValidateOrderId()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'order_id' was not supplied.");
        unset($this->params['order_id']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateCurrencyCode()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'currency' was not supplied.");
        unset($this->params['currency']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateAmount()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'amount' was not supplied.");
        unset($this->params['amount']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientName()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.name' was not supplied.");
        unset($this->params['client']['name']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientEmail()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.email' was not supplied.");
        unset($this->params['client']['email']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientDocument()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.document' was not supplied.");
        unset($this->params['client']['document']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientBirthDate()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.birth_date' was not supplied.");
        unset($this->params['client']['birth_date']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientPhone()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.phone' was not supplied.");
        unset($this->params['client']['phone']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientIp()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.ip' was not supplied.");
        unset($this->params['client']['ip']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientState()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.address.state' was not supplied.");
        unset($this->params['client']['address']['state']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientCity()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.address.city' was not supplied.");
        unset($this->params['client']['address']['city']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientZipCode()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.address.zip_code' was not supplied.");
        unset($this->params['client']['address']['zip_code']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientDistrict()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.address.district' was not supplied.");
        unset($this->params['client']['address']['district']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientStreet()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.address.street' was not supplied.");
        unset($this->params['client']['address']['street']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateClientNumber()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'client.address.number' was not supplied.");
        unset($this->params['client']['address']['number']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testValidateProducts()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'products' was not supplied.");
        unset($this->params['products']);
        \CambioReal\CambioReal::requestV2($this->params);
    }

    public function testRequestIsCorrect()
    {
        $request = \CambioReal\CambioReal::requestV2($this->params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://sandbox.cambioreal.com/service/v2/checkout/request', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
        $this->assertEquals($this->params['amount'], $request['params']['amount']);
        $this->assertEquals($this->params['currency'], $request['params']['currency']);
        $this->assertEquals($this->params['client']['name'], $request['params']['client']['name']);
        $this->assertEquals($this->params['client']['email'], $request['params']['client']['email']);
        $this->assertEquals($this->params['products'], $request['params']['products']);
    }
}
