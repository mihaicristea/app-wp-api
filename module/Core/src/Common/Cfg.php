<?php

namespace Core\Common;

use Exception;

class Cfg
{
    private static $cfg;

    public static function setCfg(string $path)
    {
        try {
            $cfg = require $path;
        } catch (Exception $e) {
            throw new Exception('Cfg file path error!');
        }

        self::$cfg = $cfg;
    }

    public static function getCfg()
    {

        if (isset(self::$cfg)) {
            return self::$cfg;
        }

        throw new Exception('Cfg file missing!');
    }
}
