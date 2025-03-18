<?php

namespace CambioReal;

/**
 * Config class (singleton, registry).
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Config
{
    /**
     * The API URL.
     */
    const URL_TEST = 'https://sandbox.cambioreal.com/';

    const URL_PRODUCTION = 'https://www.cambioreal.com/';

    /**
     * The config object instance.
     * @var \CambioReal\Config
     */
    protected static $instance = null;

    /**
     * Library settings array.
     * @var array
     */
    protected static $settings = [];

    /**
     * Protected constructor to avoid other instances.
     * Sets stuff to default values.
     */
    protected function __construct()
    {
        self::$settings['testMode'] = false;
        self::$settings['apiVersion'] = 'v1';
        self::$settings['httpRequest'] = '\\CambioReal\\Http\\Request';
    }

    /**
     * Get the class instance (singleton).
     * @return \CambioReal\Config
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Gets a setting value.
     * @param string $key The setting name
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function get($key)
    {
        self::getInstance();

        if (array_key_exists($key, self::$settings)) {
            return self::$settings[$key];
        }

        throw new \InvalidArgumentException("The key $key doesn't exist in the config settings.");
    }

    /**
     * Sets a setting.
     * @param string $key The setting name
     * @param mixed $value The setting value
     * @return void
     */
    public static function set()
    {
        self::getInstance();

        $args = func_get_args();

        if (is_array($args[0])) {
            foreach ($args[0] as $key => $value) {
                self::$settings[$key] = $value;
            }
        } else {
            self::$settings[$args[0]] = $args[1];
        }
    }

    /**
     * Magic method to get and set settings.
     * @param  string $name The method name
     * @param  string $args The method arguments
     * @return mixed
     */
    public static function __callStatic($name, $args)
    {
        // From 'getIntegrationKey' to 'integrationKey'
        $key = lcfirst(preg_replace('/^get|^set/', '', $name));

        // Magic getter method
        if (preg_match('/^get[\w]+/', $name)) {
            return self::get($key);
        }
        // Magic setter method
        elseif (preg_match('/^set[\w]+/', $name)) {
            self::set($key, $args[0]);
        }
    }

    /**
     * Gets the current API URL.
     * @return string
     */
    public static function getURL()
    {
        return (self::$settings['testMode'] ? self::URL_TEST : self::URL_PRODUCTION).'service/'.self::$settings['apiVersion'].'/checkout/';
    }

    /**
     * Gets the base URL for redirect purposes.
     * @return string
     */
    public static function getBaseURL()
    {
        return self::$settings['testMode'] ? self::URL_TEST : self::URL_PRODUCTION;
    }
}
