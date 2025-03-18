<?php

namespace CambioReal\Action;

/**
 * Action for the 'get' action.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Get extends \CambioReal\Action\AbstractAction
{
    /**
     * The HTTP method.
     * @var string
     */
    protected $method = 'GET';

    /**
     * The action URL address.
     * @var string
     */
    protected $action = 'get';

    /**
     * Validates the request parameters.
     * @param CambioReal\Action\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function validate($validator)
    {
        $validator->required('token');
    }
}
