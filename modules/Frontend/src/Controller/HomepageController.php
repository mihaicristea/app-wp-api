<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;
use Core\Common\Template;
use Core\Common\View;

class HomepageController extends AbstractController
{

    public function __construct()
    {
        $articles = $this->getTextArticles();
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

    private function getTextArticles()
    {
        $params = [
            'type' => 'post',
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'posts');

        return $textArticles;
    }

    private function getVideoArticles()
    {
        $params = [
            'type' => 'video',
            'per_page' => 3,
        ];

        $textArticles = ApiWpHelper::getData($params, 'posts');

        return $textArticles;
    }


}