<?php

namespace Frontend\Controller;

use Core\Common\ApiWpHelper;
use Core\Common\CategoryHelper;
use Core\Common\Template;
use Core\Common\View;
use Exception;

class CategoryController extends AbstractController
{
    protected $type = 'categories';

    public function __construct(array $params)
    {
        $data = ApiWpHelper::getData($params, $this->type);

        if (! is_array($data)) {
            throw new Exception('API response is not array!');
        }

        if (count($data) > 1) {
            throw new Exception('API response must have only 1 record!');
        }

        if (count($data) == 1) {

            $category = $data[0];

            $allCategories = CategoryHelper::getAllCategories();

            // Determine if category have subcategories
            $keys = array_keys(array_column($allCategories, 'parent'), $category->id);

            if (! empty($keys)) {

                $subcategories = [];

                foreach ($keys as $k) {
                    $subcategories[] = $allCategories[$k];
                }

                /**
                 * Resolve Category with subcategories
                 */
                return $this->categoryWithSubcategories($subcategories);
            } else {

                $this->params['itemsPerPage'] = 3;

                /**
                 * Resolve Final Category with posts
                 */
                $params = [
                    'categories' => $category->id
                ];

                $posts = ApiWpHelper::getData($params, 'posts');
                $this->params['countAll'] = count($posts);

                $page = 1;

                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $page = $_GET['page'];
                }

                $offset = ($page - 1) * $this->params['itemsPerPage'] + 1;

                $params['offset'] = $offset;
                $params['per_page'] = $this->params['itemsPerPage'];
                $posts = ApiWpHelper::getData($params, 'posts');

                if (is_array($posts) && count($posts) > 0) {
                    return $this->categoryWithPosts($posts);
                }
            }

        }
    }

    /**
     * Category with subcategories - list categories
     */
    private function categoryWithSubcategories(array $subcategories)
    {
        Template::setTemplate('frontend/layout/layout');
        $this->setViewLoaded();
        $this->params['subcategories'] = $subcategories;
        return new View('frontend/categories/category-subcategories-list', $this->params);
    }

    /**
     * Final category -> list posts
     */
    private function categoryWithPosts(array $posts)
    {
        Template::setTemplate('frontend/layout/layout');
        $this->setViewLoaded();
        $this->params['posts'] = $posts;
        return new View('frontend/categories/category-posts-list', $this->params);
    }

}