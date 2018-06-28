<?php

namespace Frontend\Widget;

use Core\Common\AbstractWidget;
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


        $mainCategory = $params['post']->categories[0];

        $this->categories = (array)$this->getAllCategories();

        //print_r($this->categories); die();

        $tree = $this->getTreeCategoryById($mainCategory);
        print_r($tree);


//        $breadcrumbs = array_reverse($breadcrumbs);
//
//        $out = array();
//
//        if (! empty($prepend)) {
//            foreach ($prepend as $p) {
//                $out[] = $p;
//            }
//        }
//
//        $url = '';
//        foreach ($breadcrumbs as $i => $breadcrumb) {
//
//            if ($i == 0) {
//                $url .= $breadcrumb['url'];
//            } else {
//                $url .= '/' .$breadcrumb['url'];
//            }
//
//            $out[] = array(
//                'url' => $url,
//                'title' => $breadcrumb['title'],
//            );
//        }
//
//        return $out;

    }

    private function getAllCategories() : array
    {
        $apiParams = [];

        return ApiWpHelper::getData($apiParams, 'categories', true);
    }

    private function getTreeCategoryById(int $id)
    {
        $tree = [];

        $key = array_search($id, array_column($this->categories, 'id'));

        if ($key === false) {
            throw new Exception("Category with id $id is missing!");
        }

        $category = $this->categories[$key];

        $tree[] = $category;

        if ($category['parent'] > 0) {
            $tree[] = $this->getTreeCategoryById($category['parent']);
        }

        return $tree;
    }
}