<?php

namespace Core\Common;

use Exception;

class View
{
    public function __construct(string $path, array $params = [])
    {
        $file = FileHelper::prepareFile($path);

        if (file_exists($file)) {

            $params['view'] = new ViewHelper;

            $content = FileHelper::renderPhpToString($file, $params);

            Template::addView($content);

        } else {
            throw new Exception("File ($path) not found!");
        }
    }
}