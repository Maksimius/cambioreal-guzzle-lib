<?php

require_once 'bootstrap.php';

$size = 16;
$bytes = random_bytes($size);
$order_id = substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);

/**
 * Request para criar o pagamento na CambioReal sem a necessidade de
 * redirecionamento.
 */
$response = \CambioReal\CambioReal::requestV2([
    'client' => [
        'name'       => 'John Maxxel',
        'email'      => 'john@max.com',
        'document'   => '696.601.173-88', // Change this
        'birth_date' => (date('Y') - 18) . '-01-01',
        'phone'      => '+55 11 99999-9999',
        'ip'         => '127.0.0.1',
        'address'    => [
            'state'    => 'SP',
            'city'     => 'São Paulo',
            'zip_code' => '27275-595',
            'district' => 'Jardim América',
            'street'  => 'Avenida Brasil',
            'number'   => '1120',
        ],
    ],
    'order_id'       => $order_id,
    'currency'       => 'USD',
    'amount'         => 10.00,
    'payment_method' => 'pix',
    'duplicate'      => false,
    'due_date'       => null,
    'products'       => [
        [
            'descricao'  => 'KitKat',
            'base_value' => 1.00,
            'valor'      => 5.00,
            'qty'        => 5,
            'ref'        => 'KitKat Promo',
        ],
        [
            'descricao'  => 'Frete',
            'base_value' => 5.00,
            'valor'      => 5.00,
            'ref'        => 'São Paulo - SP',
        ],
    ],
]);

var_dump($response);
