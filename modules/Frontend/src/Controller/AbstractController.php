<?php

namespace Frontend\Controller;

use Core\Common\Cfg;
use Core\Common\Download;

abstract class AbstractController
{
    protected $viewLoaded = false;

    protected function getData($params)
    {
        $cfg = Cfg::getCfg();
        $url = $cfg['wp-api-url'] . $cfg['routing-type'][$this->type] . '?' . http_build_query($params);
        $download = new Download($url);
        $data = $download->exportJson();

        return $data;
    }

    public function isViewLoaded()
    {
        return $this->viewLoaded;
    }

    protected function setViewLoaded()
    {
        $this->viewLoaded = true;
    }
}