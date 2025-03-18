<?php

namespace Mock\Http;

/**
 * Request mock for tests.
 *
 * @author Deivide Vian <dvdvian@gmail.com>
 */
class Request extends \CambioReal\Http\Request
{
    /**
     * Returns the request options/parameters instead of sending the request.
     * @return array
     */
    public function send()
    {
        return [
            'method' => $this->method,
            'action' => $this->action,
            'params' => $this->params,
            'decode' => $this->decodeResponse,
        ];
    }
}
