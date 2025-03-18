<?php

/**
 * The simulator action class.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class SimulatorTest extends TestCase
{
    public function testValidateCurrency()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'currency' was not supplied.");
        \CambioReal\CambioReal::simulator([]);
    }

    public function testValidateAmount()
    {
        $this->expectException('InvalidArgumentException', "The parameter 'amount' was not supplied.");
        \CambioReal\CambioReal::simulator(['currency' => 'USD']);
    }

    public function testSimulatorRequestIsCorrect()
    {
        $request = \CambioReal\CambioReal::simulator([
            'currency'       => 'USD',
            'amount'         => 50.00,
            'take_rates'     => false,
            'payment_method' => 'boleto',
        ]);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://sandbox.cambioreal.com/service/v1/checkout/simulator', $request['action']);
        $this->assertEquals(true, $request['decode'], true);
    }
}
