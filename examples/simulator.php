<?php

require_once 'bootstrap.php';

/**
 * Request para realizar a simulação de valores.
 */
$request = \CambioReal\CambioReal::simulator([
    'currency'       => 'USD',
    'amount'         => 50.00,
    'take_rates'     => false,
    'payment_method' => 'boleto',
]);

var_dump($request);
