<?php

require_once 'bootstrap.php';

\CambioReal\Config::setDirectMode(true);

/**
 * Request para criar a cobrança na CambioReal.
 */
$request = \CambioReal\CambioReal::request(array(
    'client' => array(
        'name'  => 'John Test',
        'email' => 'john@test.com',
    ),
    'currency'  => 'USD',
    'amount'    => 130.00,
    'order_id'  => '10000052',
    'duplicate' => false,
    'due_date'  => null,
    'products'  => array(
        array(
            'descricao'  => 'Laptop i7',
            'base_value' => 800.00,
            'valor'      => 1600.00,
            'qty'        => 2,
            'ref'        => 1,
        ),
        array(
            'descricao'  => 'Frete',
            'base_value' => 5.00,
            'valor'      => 5.00,
            'ref'        => 'São Paulo - SP',
        ),
        array(
            'descricao'  => 'Desconto',
            'base_value' => -5.00,
            'valor'      => -5.00,
            'ref'        => 'CUPOMDESCONTO5',
        ),
    ),
));

if ( ! isset($request->data))
{
    var_dump($request);
    exit;
}

/**
 * Request para registrar o cliente que está gerando o boleto.
 */
\CambioReal\CambioReal::registerAccount(array(
    'email'     => 'john@test.com',
    'cpf'       => '727.258.861-63',
    'data_nasc' => '10/10/1985',
    'nome'      => 'John Test',
    'phone1'    => '+55 45 9999-9999',
    'endereco'  => 'Av. Brasil',
    'cidade'    => 'São Paulo',
    'estado'    => 'SP',
    'pais'      => 'BR',
    'zip'       => '88888-888',
    'district'  => 'Centro',
    'number'    => '1652',
));

/**
 * Request para obter o link do boleto
 */
$response = \CambioReal\CambioReal::boleto(array(
    'id'    => $request->data->id,
    'token' => $request->data->token
));

if ($response && $response->status === 'success')
{
    header('Location: ' . $response->data->boleto);
    exit;
}

var_dump($response);