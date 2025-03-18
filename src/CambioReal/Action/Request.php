<?php

namespace CambioReal\Action;

/**
 * Request action for api.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Request extends \CambioReal\Action\AbstractAction
{
    /**
     * The HTTP method.
     *
     * @var string
     */
    protected $method = 'POST';

    /**
     * The action URL address.
     *
     * @var string
     */
    protected $action = 'request';

    /**
     * Validates the request parameters.
     *
     * @param CambioReal\Action\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function validate($validator)
    {
        $validator->required('currency');
        $validator->required('amount');
        $validator->required('order_id');
        $validator->required('client.name');
        $validator->required('client.email');
        $validator->required('products');
    }
}
