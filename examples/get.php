<?php

require_once 'bootstrap.php';

/**
 * Request para criar a cobrança na CambioReal para o teste.
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
            'ref'        => 'UHAD123DD',
            'category'   => 'Laptop',
            'brand'      => 'Asus',
            'sku'        => 'LAI71239123',
        ],
        [
            'descricao'  => 'Frete',
            'base_value' => 5.00,
            'valor'      => 5.00,
            'ref'        => 'São Paulo - SP',
        ],
        [
            'descricao'  => 'Bônus',
            'base_value' => -5.00,
            'valor'      => -5.00,
            'ref'        => 'Discount CODE123',
        ],
    ],
]);

/**
 * Request para consultar uma cobrança na CambioReal.
 *
 * Status possíveis de uma solicitação:
 * PENDENTE_ACCOUNT - Conta bancária da empresa está pendente de aprovação.
 * AGUARDANDO_CLIENTE - Aguardando cliente gerar o boleto
 * BOLETO_GERADO - Boleto gerado
 * BOLETO_EXPIRADO - Boleto expirado
 * BOLETO_CANCELADO - Boleto cancelado pelo banco
 * SOLICITACAO_RECUSADA - Cliente recusou a solicitação de cobrança
 * SOLICITACAO_INVALIDA - Solicitação inválida
 * SOLICITACAO_CANCELADA - Empresa cancelou a solicitação
 * SOLICITACAO_PAGO - Solicitação paga
 * SOLICITACAO_FINALIZADA - Solicitação enviada para pagamento ao destinatário
 * SOLICITACAO_EXPIRADA - Solicitação expirada
 */
$response = \CambioReal\CambioReal::get([
    'id'    => $request->data->id,
    'token' => $request->data->token,
]);

if ($response->status === 'success') {
    var_dump($response);
}
