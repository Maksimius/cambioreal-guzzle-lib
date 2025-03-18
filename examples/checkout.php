<?php

require_once 'bootstrap.php';

/**
 * Request para criar a cobrança na CambioReal.
 */
$request = \CambioReal\CambioReal::request([
    'client' => [
        'name'  => 'John Test',
        'email' => 'john@test.com',
    ],
    'currency'  => 'USD',
    'amount'    => 130.00,
    'order_id'  => '10000052',
    'duplicate' => false,
    'due_date'  => null,
    'products'  => [
        [
            'descricao'  => 'Laptop i7',
            'base_value' => 800.00,
            'valor'      => 1600.00,
            'qty'        => 2,
            'ref'        => 1,
        ],
        [
            'descricao'  => 'Frete',
            'base_value' => 5.00,
            'valor'      => 5.00,
            'ref'        => 'São Paulo - SP',
        ],
    ],
]);

var_dump($request);
