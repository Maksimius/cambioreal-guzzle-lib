<?php

/**
 * Config class tests.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class ConfigTest extends TestCase
{
    public function testUrlTestMode()
    {
        \CambioReal\Config::set('testMode', false);
        $this->assertEquals('https://www.cambioreal.com/service/v1/checkout/', \CambioReal\Config::getURL());

        \CambioReal\Config::set('testMode', true);
        $this->assertEquals('https://sandbox.cambioreal.com/service/v1/checkout/', \CambioReal\Config::getURL());
    }

    public function testSettingCanBeSetAndRetrieved()
    {
        \CambioReal\Config::set('optionFromTest', 'starWars');
        $this->assertEquals('starWars', \CambioReal\Config::get('optionFromTest'));
    }

    public function testInvalidSetting()
    {
        $this->expectException('InvalidArgumentException');
        \CambioReal\Config::get('invalidConfigTest');
    }

    public function testSetManySettings()
    {
        \CambioReal\Config::set([
            'foo' => true,
              'bar' => '12345678',
        ]);

        $this->assertEquals(true, \CambioReal\Config::getFoo());
        $this->assertEquals(true, \CambioReal\Config::get('foo'));
        $this->assertEquals('12345678', \CambioReal\Config::getBar());
        $this->assertEquals('12345678', \CambioReal\Config::get('bar'));
    }
}
