<?php

namespace CambioReal\Action;

/**
 * The actions factory class.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Factory
{
    /**
     * Returns an instance of the action class.
     * @param  string $name The action name in the form 'doCommand'
     * @return \CambioReal\Action\AbstractAction
     * @throws RuntimeException
     */
    public static function build($className)
    {
        $className = ucfirst($className);
        $class = '\\CambioReal\\Action\\'.$className;

        if (class_exists($class)) {
            return new $class();
        } else {
            throw new \RuntimeException("Action '$className' doesn't exist.");
        }
    }
}
