<?php

namespace Frontend\Controller;

use Core\Common\Cfg;
use Core\Common\Template;
use Core\Common\UrlHelper;
use Core\Common\View;

class GenericController
{
    public function __construct()
    {
        $this->index();
    }

    private function index()
    {
        $url = UrlHelper::getUrl();

        $cfg = Cfg::getCfg();
        $routes = $cfg['routes'];

        if (isset($routes[$url])) {
            return new $routes[$url];
        }

        if ($url == '') {
            return new HomepageController();
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
            Template::setTemplate('frontend/layout/layout');
            return new View('frontend/404', []);
        }
    }

}