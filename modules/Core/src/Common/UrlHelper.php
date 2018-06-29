<?php

namespace Core\Common;

class UrlHelper
{
    private static $url;
    private static $urlSegments;

    private static function setUrl()
    {
        if (isset($_GET['p']) && trim($_GET['p']) != '') {

            self::$url = trim($_GET['p']);

            $urlSegments = explode('/', $_GET['p']);

            if (count($urlSegments) > 0) {
                self::$urlSegments = $urlSegments;
            }

        } else {
            self::$url = '';
            self::$urlSegments = [];
        }
    }

    public static function getUrl()
    {
        if (! isset(self::$url)) {
            self::setUrl();
        }
        return self::$url;
    }

    public static function getUrlSegments()
    {
        if (! isset(self::$url)) {
            self::setUrl();
        }
        return self::$urlSegments;
    }

    public static function getCategoryUrlTreeBySlug(string $slug)
    {
        $tree = CategoryHelper::getTreeCategoryBySlug($slug);
        $tree = array_reverse($tree);

        $link = APP_URL;

        foreach ($tree as $category) {
            $link .= '/' . $category['slug'];
        }

        return $link;
    }

    public static function getPostUrlTree(array $params)
    {
        if (! isset($params['post'])) {
            throw new Exception("Param post missing!");
        }

        if (! isset($params['post']->categories) || ! is_array($params['post']->categories)) {
            throw new Exception("Property categories missing!");
        }

        $post = $params['post'];

        $link = APP_URL;

        if (isset($post->categories) && is_array($post->categories) && ! empty($post->categories)) {
            $mainCategory = $post->categories[0];

            $tree = CategoryHelper::getTreeCategoryById($mainCategory);
            $tree = array_reverse($tree);

            foreach ($tree as $category) {
                $link .= '/' . $category['slug'];
            }
        }

        $link .= '/' . $post->slug;

        return $link;

    }
}