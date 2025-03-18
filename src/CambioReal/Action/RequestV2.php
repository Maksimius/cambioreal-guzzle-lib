<?php

namespace CambioReal\Action;

/**
 * Request action V2 for api.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class RequestV2 extends \CambioReal\Action\AbstractAction
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
     * API version for the action.
     *
     * @var string
     */
    protected $apiVersion = 'v2';

    /**
     * Validates the request parameters.
     *
     * @param CambioReal\Action\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function validate($validator)
    {
        $validator->required('order_id');
        $validator->required('currency');
        $validator->required('amount');
        $validator->required('payment_method');
        $validator->required('client.name');
        $validator->required('client.email');
        $validator->required('client.document');
        $validator->required('client.birth_date');
        $validator->required('client.phone');
        $validator->required('client.ip');
        $validator->required('client.address.state');
        $validator->required('client.address.city');
        $validator->required('client.address.zip_code');
        $validator->required('client.address.district');
        $validator->required('client.address.street');
        $validator->required('client.address.number');
        $validator->required('products');
    }
}
