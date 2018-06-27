<?php

namespace Core\Common;

class View
{
    public function __construct(string $file)
    {
        $file = APP_PATH . '/module/Core/src/View/' . $file . '.phtml';

        if (file_exists($file)) {
            require $file;
        }
    }
}