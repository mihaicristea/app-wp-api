<?php

namespace Core\Common;

use Exception;

class AbstractWidget
{
    protected $params;

    public function __construct(array $params = [])
    {
        if (method_exists($this, $params['method'])) {
            $this->{$params['method']}($params['params']);
        } else {
            throw new Exception("Method {$params['method']} not found!");
        }
    }
}