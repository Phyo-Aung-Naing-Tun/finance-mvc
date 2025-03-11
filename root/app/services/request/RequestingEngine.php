<?php

namespace Root\App\Services\Request;

abstract class RequestingEngine
{

    private $server;
    public $method;
    public $url;
    public $host;
    public $headers = [];
    public $param; //data from get method
    public $body; //data from post method
    public $clientIp;
    public $userAgent;

    protected function __construct()
    {
        $this->server = $_SERVER;
        $this->setMethod()
            ->setUrl()
            ->setHost()
            ->setHeaders()
            ->setParam()
            ->setBody()
            ->setClientIp()
            ->setUserAgent();
    }

    public function setMethod($method = null)
    {
        $this->method = $method ? $method : $this->server['REQUEST_METHOD'] ?? 'GET';
        return $this;
    }

    public function setUrl($url = null)
    {
        $this->url = $url ? $url : $this->server['REQUEST_URI'] ?? '/';
        return $this;
    }

    public function setHost($host = null)
    {
        $this->host = $host ? $host : $this->server['HTTP_HOST'] ?? '';
        return $this;
    }

    public function setParam($param = null)
    {
        $this->param = $param ? $param : $_GET;
        return $this;
    }

    public function setBody($body = null)
    {
        $this->body = $body ? $body : $_POST;
        return $this;
    }

    public function setClientIp($clientIp = null)
    {
        $this->clientIp = $clientIp ? $clientIp : $this->server['REMOTE_ADDR'] ?? '0.0.0.0';
        return $this;
    }

    public function setUserAgent($userAgent = null)
    {
        $this->userAgent = $userAgent ? $userAgent : $this->server['HTTP_USER_AGENT'] ?? 'Unknown';
        return $this;
    }

    public function setHeaders($headers = [])
    {
        $formatHeaders = [];

        foreach ($this->server as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headerName = str_replace('_', '-', substr($key, 5));
                $headers[ucwords(strtolower($headerName), '-')] = $value;
            }
        }

        $this->headers = array_push($formatHeaders, $headers);

        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getParams(): array
    {
        return $this->param;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function all(): array
    {
        return [...$this->getParams(), ...$this->getBody()];
    }
}
