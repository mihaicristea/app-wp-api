<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;
use Core\Common\Template;
use Core\Common\View;
use Exception;

class SearchController
{
    public function __construct()
    {
        $keyword = '';

        if (isset($_GET['q'])) {
            if (preg_match("/[^a-zA-Z0-9\/ ]+/i", $_GET['q'])) {
                throw new Exception("Invalid search keyword!");
            }
            $keyword = $_GET['q'];
        }

        $articles = $this->getArticles($keyword);

        Template::setTemplate('frontend/layout/layout');
        $params = [
            'posts' => $articles
        ];

        new View('frontend/search/index', $params);
    }

    private function getArticles($keyword)
    {
        $params = [
            'search' => $keyword,
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'posts');

        return $textArticles;
    }

}