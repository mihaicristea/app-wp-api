<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;
use Core\Common\Template;
use Core\Common\View;

class SearchController
{
    public function __construct()
    {
        $articles = $this->getArticles();

        Template::setTemplate('frontend/layout/layout');
        $params = [
            'posts' => $articles
        ];
        new View('frontend/search/index', $params);
    }

    private function getArticles()
    {
        $params = [
            'search' => 'dolo',
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'posts');

        return $textArticles;
    }

}