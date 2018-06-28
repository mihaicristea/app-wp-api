<?php

namespace Frontend\Controller;

use Core\Common\View;
use Exception;

class CategoryController extends AbstractController
{
    protected $type = 'categories';

    public function __construct(array $params)
    {
        $data = $this->getData($params);

        if (! is_array($data)) {
            throw new Exception('API response is not array!');
        }

        if (count($data) > 1) {
            throw new Exception('API response must have only 1 record!');
        }

        if (count($data) == 1) {

            $data = $data[0];

            /**
             * Resolve Category with subcategories
             */
            $params = [
                'parent' => $data->id
            ];

            $subcategories = $this->getData($params);

            if (is_array($subcategories) && count($subcategories) > 0) {
                $this->params['subcategories'] = $subcategories;
                return $this->categoryWithSubcategories($subcategories);
            }

            /**
             * Resolve Final Category with posts
             */
            $params = [
                'categories' => $data->id
            ];

            $posts = $this->getData($params);

            if (is_array($posts) && count($posts) > 0) {
                $this->params['posts'] = $posts;
                return $this->categoryWithPosts($posts);
            }

        }
    }

    /**
     * Category with subcategories - list categories
     */
    private function categoryWithSubcategories()
    {
        $this->setViewLoaded();
        return new View('frontend/categories/category-subcategories-list', $this->params);
    }

    /**
     * Final category -> list posts
     */
    private function categoryWithPosts(array $posts)
    {
        $this->setViewLoaded();
        return new View('frontend/categories/category-posts-list', $this->params);
    }

}