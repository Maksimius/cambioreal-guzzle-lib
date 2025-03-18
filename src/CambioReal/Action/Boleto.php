<?php namespace CambioReal\Action;

/**
 * Action for get boleto
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Boleto extends \CambioReal\Action\AbstractAction
{
    /**
     * The HTTP method
     * @var string
     */
    protected $method = 'GET';

    /**
     * The action URL address
     * @var string
     */
    protected $action = 'boleto';

    /**
     * Validates the request parameters
     * @param CambioReal\Action\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function validate($validator)
    {
        $validator->required('token');
    }
}