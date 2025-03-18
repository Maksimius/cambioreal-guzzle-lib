<?php

/**
 * The actions factory class.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class FactoryTest extends TestCase
{
    public function testBuildValidAction()
    {
        $this->assertInstanceOf('\\CambioReal\\Action\\Cancel', \CambioReal\Action\Factory::build('cancel'));
    }

    public function testBuildInvalidAction()
    {
        $command = 'fooBar';
        $this->expectException('RuntimeException', "Action 'fooBar' doesn't exist.");
        \CambioReal\Action\Factory::build($command);
    }
}
