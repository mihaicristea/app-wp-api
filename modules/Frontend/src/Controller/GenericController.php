<?php

namespace Frontend\Controller;

use Core\Common\UrlHelper;

class GenericController
{
    public function __construct()
    {
        $this->index();
    }

    private function index()
    {
        $url = UrlHelper::getUrl();

        if ($url == '') {
            $controller = new HomepageController();
            return;
        }

        $urlSegments = UrlHelper::getUrlSegments();

        if (count($urlSegments) > 0) {
            $urlSegments = array_reverse($urlSegments);
        }

        $slug = $urlSegments[0];

        $params = [
            'slug' => $slug
        ];

        $isViewLoaded = false;

        /**
         * Article Controller
         */
        $controller = new ArticleController($params);
        if ($controller->isViewLoaded()) {
            $isViewLoaded = true;
        }

        /**
         * Category Controller
         */
        $controller =  new CategoryController($params);
        if ($controller->isViewLoaded()) {
            $isViewLoaded = true;
        }

        if (! $isViewLoaded) {
            throw new \Exception('Controller not found!');
        }
    }

}