<?php

class Request
{
    private $server;

    private function __construct()
    {
        $this->server = $_SERVER;
    }

    public static function initialize(): self
    {
        return new self();
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function getUri(): string
    {
        return $this->server['REQUEST_URI'] ?? '/';
    }

    public function getHost(): string
    {
        return $this->server['HTTP_HOST'] ?? '';
    }

    public function getHeaders(): array
    {
        $headers = [];
        foreach ($this->server as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headerName = str_replace('_', '-', substr($key, 5));
                $headers[ucwords(strtolower($headerName), '-')] = $value;
            }
        }
        return $headers;
    }

    public function getQueryParams(): array
    {
        return $_GET;
    }

    public function getPostData(): array
    {
        return $_POST;
    }

    public function getClientIp(): string
    {
        return $this->server['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    public function getUserAgent(): string
    {
        return $this->server['HTTP_USER_AGENT'] ?? 'Unknown';
    }
}
