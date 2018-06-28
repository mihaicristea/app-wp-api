<?php

namespace Core\Common;

use Exception;

class FileHelper
{
    /**
     * @param string $path - module/tree/file
     * @return string
     * @throws Exception
     */
    public static function prepareFile(string $path)
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

        $module = $path[0];
        $module = explode('-', $module);
        $module = array_map('ucfirst', $module);
        $module = implode('', $module);

        array_shift($path);

        $tree = '';
        if (count($path) > 0) {
            $tree = implode('/', $path) . '/';
        }

        $realPath = APP_PATH . "/modules/$module/src/View/$tree$file";

        return $realPath;
    }

    public static function renderPhpToString($file, array $params = [])
    {
        if (! empty($params)) {
            extract($params);
        }

        ob_start();
        require $file;
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}