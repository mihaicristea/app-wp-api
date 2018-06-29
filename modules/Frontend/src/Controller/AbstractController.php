<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;

abstract class AbstractController
{
    protected $viewLoaded = false;
    protected $params = [];

    protected function getData(array $params)
    {
        foreach ($this->types as $type) {
            $posts = ApiWpHelper::getData($params, $type);

            if (is_array($posts) && ! empty($posts)) {
                return $posts;
            }
        }

        return [];
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