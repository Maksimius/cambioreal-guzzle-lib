# CambioReal PHP Library
This library enables you to integrate CambioReal with any PHP application.

## Requirements
* PHP >= 5.3
* cURL

## Usage
### Setup
To use the CambioReal PHP library you need to setup your app id and app secret.
``` php
\CambioReal\Config::setAppId('your-app-id');
\CambioReal\Config::setAppSecret('your-app-secret');
```

If you need to change other settings, you can use the following function call:
``` php
\CambioReal\Config::set([
    'appId'      => 'your-app-id',
    'appSecret'  => 'your-app-secret',
    'testMode' => true,
]);
```

You can change the following settings:
* appId: your app id. It will be different in test and production modes.
* appSecret: your app secret. It will be different in test and production modes.
* testMode: enable or disable the test mode. The default value is _false_.

To create a new API request, just call one of the following methods on the \CambioReal\CambioReal
class and supply it with the request parameters:
* \CambioReal\CambioReal::cancel
* \CambioReal\CambioReal::get
* \CambioReal\CambioReal::request

request command example:
``` php
require_once __DIR__ . 'vendor/autoload.php';

\CambioReal\Config::setAppId('11250214');
\CambioReal\Config::setAppSecret('6e556ff76e55...56ff7');

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
```

## Changelog
* **1.0.0**: first release.
* **1.1.0**: get and print boleto.
* **1.2.0**: boleto returned in pdf.
* **1.2.1**: Added the amount simulator.
* **1.3.0**: removed the generation of boletos and the boleto endpoint.
* **1.4.0**: Added support for request V2 used in pix transparent payments.
