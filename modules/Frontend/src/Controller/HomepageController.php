<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;
use Core\Common\Template;
use Core\Common\View;

class HomepageController extends AbstractController
{

    public function __construct()
    {
        $articles = $this->getArticles();
        $textArticles = $this->getTextArticles();
        $videoArticles = $this->getVideoArticles();

        $params = [
            'articles' => $articles,
            'textArticles' => $textArticles,
            'videoArticles' => $videoArticles,
        ];

        Template::setTemplate('frontend/layout/layout');
        new View('frontend/homepage/index', $params);

    }

    private function getArticles()
    {
        $params = [
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'posts');

        return $textArticles;
    }

    private function getTextArticles()
    {
        $params = [
            'sticky' => true,
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'posts');

        return $textArticles;
    }

    private function getVideoArticles()
    {
        $params = [
            'order_by' => 'date',
            'order' => 'desc',
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'videos');

        return $textArticles;
    }


}