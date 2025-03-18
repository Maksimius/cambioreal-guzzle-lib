<?php

namespace CambioReal\Action;

/**
 * Action for the 'register' action. Performs the user registration.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class RegisterAccount extends \CambioReal\Action\AbstractAction
{
    /**
     * The HTTP method.
     * @var string
     */
    protected $method = 'POST';

    /**
     * The action URL address.
     * @var string
     */
    protected $action = 'register-account';

    /**
     * Validates the request parameters.
     * @param CambioReal\Action\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function validate($validator)
    {
        $validator->required('email');
        $validator->required('cpf');
        $validator->required('nome');
        $validator->required('data_nasc');
        $validator->required('phone1');
        $validator->required('endereco');
        $validator->required('cidade');
        $validator->required('estado');
        $validator->required('zip');
        $validator->required('district');
        $validator->required('number');
    }
}
