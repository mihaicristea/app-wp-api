<?php

namespace Frontend\Controller;

use Core\Common\Cfg;
use Core\Common\Url;

class ArticleController
{
    public function __construct()
    {

        $url = new Url

        $cfg = Cfg::getCfg();
        $url = $cfg['wp-api-url'] . $cfg['routing-type']['posts'] . '?' . http_build_query($params);
        $download = new Download($url);
        $data = $download->exportJson();
    }
}