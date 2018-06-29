<?php

namespace Frontend\Widget;

use Core\Common\AbstractWidget;
use Core\Common\Cfg;
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

        if (! isset($params['post']->categories) || ! is_array($params['post']->categories)) {
            throw new Exception("Property categories missing!");
        }

        $post = $params['post'];

        $mainCategory = $post->categories[0];

        $this->categories = (array)$this->getAllCategories();

        $tree = $this->getTreeCategoryById($mainCategory);
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

        $link .= '/' . $post->slug;
        $breadcrumbs[] = [
            'link' => $link,
            'name' => $post->title->rendered
        ];

        $params = [
            'breadcrumbs' => $breadcrumbs
        ];

        new View('frontend/widgets/breadcrumbs', $params);

    }

    private function getAllCategories() : array
    {
        $apiParams = [];

        return ApiWpHelper::getData($apiParams, 'categories', true);
    }

    private function getTreeCategoryById(int $id, array &$tree = []) : array
    {
        $key = array_search($id, array_column($this->categories, 'id'));

        if ($key === false) {
            throw new Exception("Category with id $id is missing!");
        }

        $category = $this->categories[$key];

        $tree[] = $category;

        if ($category['parent'] > 0) {
            $this->getTreeCategoryById($category['parent'], $tree);
        }

        return $tree;
    }

}