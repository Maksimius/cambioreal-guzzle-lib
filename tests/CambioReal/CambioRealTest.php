<?php

/**
 * CambioReal class tests.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class CambioRealTest extends TestCase
{
    public function testCallInvalidAction()
    {
        $this->expectException('RuntimeException', "Action 'starWars' doesn't exist.");
        \CambioReal\CambioReal::starWars('teste');
    }

    public function testCallActionWithoutArguments()
    {
        $this->expectException('InvalidArgumentException', 'The action call received no arguments.');
        \CambioReal\CambioReal::request();
    }
}
