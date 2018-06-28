<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;

abstract class AbstractController
{
    protected $viewLoaded = false;
    protected $params = [];

    protected function getData($params)
    {
        return ApiWpHelper::getData($params, $this->type);
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