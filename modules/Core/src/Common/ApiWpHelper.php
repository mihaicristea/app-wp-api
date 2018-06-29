<?php

namespace Core\Common;

class ApiWpHelper
{
    public static function getData(array $params, string $type, bool $arrayFormat = false)
    {
        $cfg = Cfg::getCfg();

        if (isset($params['id'])) {
            $id = $params['id'];
            unset($params['id']);
            $url = $cfg['wp-api-url'] . $cfg['routing-type'][$type] . '/' . $id . '?' . http_build_query($params);
        } else {
            $url = $cfg['wp-api-url'] . $cfg['routing-type'][$type] . '?' . http_build_query($params);
        }

        $download = new Download($url);
        $data = $download->exportJson($arrayFormat);

        return $data;
    }
}