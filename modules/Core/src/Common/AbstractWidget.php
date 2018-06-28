<?php

namespace Core\Common;

class AbstractWidget
{
    protected $params;

    public function __construct(array $params = [])
    {
        var_dump($params); die();
        var_dump(method_exists($this,$params['method'])); die();
        $this->$params['method']($params);
    }
}