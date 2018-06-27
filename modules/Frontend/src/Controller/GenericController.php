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
            //@TODO: homepage controller
            die('homepage');
        }

        $cfg = Cfg::getCfg();

        $urlSegments = Url::getUrlSegments();

        if (count($urlSegments) > 0) {
            array_reverse($urlSegments);
        }

        $slug = $urlSegments[0];

        $params = [
            'slug' => $slug
        ];

        foreach ($cfg['routing-type'] as $type => $apiUrl) {
            switch ($type) {
                case 'posts':
                    new ArticleController($params);
                    break;

                default:
                    throw new \Exception('Controller not found!');
            }
        }

    }

}