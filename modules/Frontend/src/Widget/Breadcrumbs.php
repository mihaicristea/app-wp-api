<?php

namespace Frontend\Widget;

use Core\Common\AbstractWidget;
use Core\Common\CategoryHelper;
use Core\Common\Cfg;
use Core\Common\UrlHelper;
use Core\Common\View;
use Exception;
use Core\Common\ApiWpHelper;

class Breadcrumbs extends AbstractWidget
{

    private $categories = [];

    public function getPostBreadcrumbs(array $params)
    {
        if (! isset($params['post'])) {
            throw new Exception("Param post missing!");
        }

        $post = $params['post'];
        $link = APP_URL;

        if (isset($params['post']->categories) && is_array($params['post']->categories) && ! empty($params['post']->categories)) {
            $mainCategory = $post->categories[0];

            $this->categories = CategoryHelper::getAllCategories();

            $tree = CategoryHelper::getTreeCategoryById($mainCategory);
            $tree = array_reverse($tree);

            $breadcrumbs = [];
            foreach ($tree as $category) {
                $link .= '/' . $category['slug'];
                $breadcrumbs[] = [
                    'link' => $link,
                    'name' => $category['name']
                ];
            }
        }

        $link .= '/' . $post->slug;
        $breadcrumbs[] = [
            'link' => $link,
            'name' => $post->title->rendered
        ];

        $params = [
            'breadcrumbs' => $breadcrumbs
        ];

        return View::renderWidget('frontend/widgets/breadcrumbs', $params);
    }

    public function getCategoryBreadcrumbs(array $params = [])
    {

        $urlSegments = UrlHelper::getUrlSegments();

        $slug = $urlSegments[count($urlSegments) - 1];

        $tree = CategoryHelper::getTreeCategoryBySlug($slug);
        $tree = array_reverse($tree);

        $link = APP_URL;

        $breadcrumbs = [];
        foreach ($tree as $category) {
            $link .= '/' . $category['slug'];
            $breadcrumbs[] = [
                'link' => $link,
                'name' => $category['name']
            ];
        }

        $params = [
            'breadcrumbs' => $breadcrumbs
        ];

        return View::renderWidget('frontend/widgets/breadcrumbs', $params);

    }

}