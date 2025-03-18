<?php

namespace CambioReal\Http;

use CambioReal\Config;
use GuzzleHttp;

/**
 * HTTP client class, wrapper for curl_* functions.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Request
{
    /**
     * The request HTTP method.
     * @var string
     */
    protected $method;

    /**
     * The allowed HTTP methods.
     * @var array
     */
    protected $allowedMethods = ['POST', 'GET'];

    /**
     * The HTTP action (URI).
     * @var string
     */
    protected $action;

    /**
     * The request parameters.
     * @var array
     */
    protected $params;

    /**
     * Flag to call json_decode on response.
     * @var bool
     */
    protected $decodeResponse = false;

    /**
     * Set the request parameters.
     * @param array $params The request parameters
     * @return CambioReal\Http\Request
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Set the request HTTP method.
     * @param string $method The request HTTP method
     * @return CambioReal\Http\Request
     * @throws InvalidArgumentException
     */
    public function setMethod($method)
    {
        if (! in_array(strtoupper($method), $this->allowedMethods)) {
            throw new \InvalidArgumentException("The HTTP Request doesn't accept $method requests.");
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Set the request target URI.
     * @param string $action The target URI
     * @return CambioReal\Http\Request
     */
    public function setAction($action)
    {
        $this->action = Config::getURL().$action;

        return $this;
    }

    /**
     * Set the decodeResponse flag depending on the response type (JSON or HTML).
     * @param string $responseType The response type (JSON or HTML)
     * @return CambioReal\Http\Request
     */
    public function setResponseType($responseType)
    {
        if (strtoupper($responseType) == 'JSON') {
            $this->decodeResponse = true;
        }

        return $this;
    }

    /**
     * Sends the HTTP request.
     * @return StdClass
     */
    public function send()
    {
        $client = new GuzzleHttp\Client();
        $uri = $this->action;

        $options = [
            'headers' => [
                'User-Agent' => 'CAMBIOREAL PHP Library ' . \CambioReal\CambioReal::VERSION,
                'X-APP-ID' => Config::getAppId(),
                'X-APP-SECRET' => Config::getAppSecret()
            ],
            'http_errors' => false
        ];

        // Обрабатываем token, если есть
        if (isset($this->params['token'])) {
            $uri .= '/' . $this->params['token'];
            unset($this->params['token']);
        }

        // Правильно распределяем параметры в зависимости от HTTP метода
        if (strtoupper($this->method) === 'GET') {
            $options['query'] = $this->params;
        } else {
            $options['form_params'] = $this->params;
        }

        $response = $client->request($this->method, $uri, $options);
        $body = (string) $response->getBody();

        if ($body && strlen($body)) {
            if ($this->decodeResponse) {
                return json_decode($body);
            }
            return $body;
        }

        throw new \RuntimeException("Bad HTTP request: " . $response->getStatusCode());
    }
}
