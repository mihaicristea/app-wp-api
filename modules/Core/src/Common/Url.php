<?php

namespace Core\Common;

class Url
{
    private static $url;
    private static $urlSegments;

    private static function setUrl()
    {
        if (isset($_GET['p']) && trim($_GET['p']) != '') {

            self::$url = trim($_GET['p']);

            $urlSegments = explode('/', $_GET['p']);

            if (count($urlSegments) > 0) {
                self::$urlSegments = $urlSegments;
            }

        } else {
            self::$url = '';
            self::$urlSegments = [];
        }
    }

    public static function getUrl()
    {
        if (! isset(self::$url)) {
            self::setUrl();
        }
        return self::$url;
    }

    public static function getUrlSegments()
    {
        if (! isset(self::$url)) {
            self::setUrl();
        }
        return self::$urlSegments;
    }
}