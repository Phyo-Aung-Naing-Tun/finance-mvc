<?php

namespace Root\App\Services\Request;


class Request extends RequestingEngine
{
    public static function initialize(): self
    {
        return new self();
    }
}
