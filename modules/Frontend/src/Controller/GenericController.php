<?php

namespace Frontend\Controller;

use Core\Common\Cfg;
use Core\Common\Url;

class GenericController
{
    public function __construct()
    {
        $this->index();
    }

    private function index()
    {
        $url = Url::getUrl();

        if ($url == '') {
            die('homepage');
        }

        $cfg = Cfg::getCfg();

        foreach ($cfg['routing-type'] as $type => $apiUrl) {
            switch ($type) {
                case 'posts':
                    new ArticleController();
                    break;

                default:
                    throw new \Exception('Controller not found!');
            }
        }

    }

}