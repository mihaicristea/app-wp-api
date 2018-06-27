<?php

namespace Core\Common;

class Url
{
    private $url;
    private $urlSegments;

    public function __construct()
    {
        if (isset($this->url)) {
            return $this->url;
        }

        if (isset($_GET['p']) && trim($_GET['p']) != '') {

            $this->url = trim($_GET['p']);

            $urlSegments = explode('/', $_GET['p']);

            if (count($urlSegments) > 0) {
                $this->urlSegments = $urlSegments;
            }

        } else {
            $this->url = '';
            $this->urlSegments = [];
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getUrlSegments()
    {
        return $this->urlSegments;
    }
}