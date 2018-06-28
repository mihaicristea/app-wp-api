<?php

use Core\Common\Cfg;
use Core\Common\Download;

class ApiWpHelper
{
    public static function getData($params, $type)
    {
        $cfg = Cfg::getCfg();
        $url = $cfg['wp-api-url'] . $cfg['routing-type'][$type] . '?' . http_build_query($params);
        $download = new Download($url);
        $data = $download->exportJson();

        return $data;
    }
}