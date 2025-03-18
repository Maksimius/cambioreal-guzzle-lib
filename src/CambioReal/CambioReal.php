<?php

namespace CambioReal;

/**
 * The CambioReal API client.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class CambioReal
{
    /**
     * Library version.
     * @var string
     */
    const VERSION = '1.3.0';

    /**
     * Magic method that calls the Action Factory.
     * @param string $name The method name
     * @param string $args The method arguments ($args[0] for the parameters array)
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function __callStatic($name, $args)
    {
        if (! isset($args[0])) {
            throw new \InvalidArgumentException('The action call received no arguments.');
        }

        $action = \CambioReal\Action\Factory::build($name);

        return $action->execute($args[0]);
    }
}
