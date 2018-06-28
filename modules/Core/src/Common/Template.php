<?php

namespace Core\Common;

class Template
{
    public static $path;
    public static $content = '';

    public static function setTemplate(string $path)
    {
        $path = FileHelper::prepareFile($path);

        if (file_exists($path)) {

            self::$path = $path;
        } else {
            throw new Exception("Template ($path) not found!");
        }
    }

    public static function render()
    {
        $params['content'] = self::$content;

        if (! empty($params)) {
            extract($params);
        }

        require self::$path; // load layout
    }

    public static function addView($content)
    {
        self::$content .= $content;
    }

}