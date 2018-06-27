<?php

namespace Core\Common;

use Exception;

class View
{

    public function __construct(string $path)
    {
        //$path = APP_PATH . '/modules/Core/src/View/' . $path . '.phtml';

        $path = $this->prepareFile($path);

        if (file_exists($path)) {
            require $path;
        } else {
            throw new Exception("File ($path) not found!");
        }
    }

    /**
     * @param string $path - module/tree/file
     * @throws Exception
     */
    private function prepareFile(string $path)
    {
        if (preg_match("/[^a-z0-9\/-]+/i", $path)) {
            throw new Exception("Invalid path");
        }

        $path = explode('/', $path);

        if (count($path) < 2) {
            throw new Exception("Invalid path!");
        }

        $file = $path[count($path) - 1] . '.phtml';
        array_pop($path);

        $path = array_map(function($n) {

            $n = explode('-', $n);
            $n = array_map('ucfirst', $n);
            $n = implode('', $n);

            return ucfirst($n);
        }, $path);

        var_dump($path); die();

        $module = $path[0];
        array_shift($path);

        $tree = implode('/', $path);

        $realPath = APP_PATH . "/modules/$module/src/View/ . $tree . '/' . $file" . '.phtml';

        var_dump($realPath); die();

    }
}