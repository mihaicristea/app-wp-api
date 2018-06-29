<?php

namespace Core\Common;

use Exception;

class AbstractWidget
{
    protected $params;
    protected $content;

    public function __construct(array $params = [])
    {
        if (method_exists($this, $params['method'])) {
            $this->content = $this->{$params['method']}($params['params']);
        } else {
            throw new Exception("Method {$params['method']} not found!");
        }
    }

    public function __toString()
    {
        if (! isset($this->content)) {
            return '';
        }

        return $this->content;
    }
}