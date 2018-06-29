<?php

namespace Core\Common;

class ApiWpHelper
{
    public static function getData(array $params, string $type, bool $arrayFormat = false)
    {
        $cfg = Cfg::getCfg();
        $url = $cfg['wp-api-url'] . $cfg['routing-type'][$type] . '?' . http_build_query($params);

        $download = new Download($url);
        $data = $download->exportJson($arrayFormat);

        return $data;
    }
}