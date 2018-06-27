<?php

namespace Frontend\Controller;

use Core\Common\Cfg;
use Core\Common\Download;
use Core\Common\Url;
use Core\Common\View;
use Exception;

class ArticleController
{
    public function __construct()
    {
        $urlSegments = Url::getUrlSegments();

        if (count($urlSegments) > 0) {
            array_reverse($urlSegments);
        }

        $slug = $urlSegments[0];

        $params = [
            'slug' => $slug
        ];

        $cfg = Cfg::getCfg();
        $url = $cfg['wp-api-url'] . $cfg['routing-type']['posts'] . '?' . http_build_query($params);
        $download = new Download($url);
        $data = $download->exportJson();

        if (! is_array($data)) {
            throw new Exception('API response is not array!');
        }

        if (count($data) > 1) {
            throw new Exception('API response must have only 1 record!');
        }

        if (count($data) == 1) {
            new View('frontend/articles/article', ['mix' => 'cool']);
            die('article');
        }
    }
}