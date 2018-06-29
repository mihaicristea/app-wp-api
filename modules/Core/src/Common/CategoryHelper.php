<?php

namespace Core\Common;

use Exception;

class CategoryHelper
{
    private static $categories;

    public static function getTreeCategoryById(int $id, array &$tree = []) : array
    {
        if (! isset(self::$categories)) {
            self::getAllCategories();
        }

        $key = array_search($id, array_column(self::$categories, 'id'));

        if ($key === false) {
            throw new Exception("Category with id $id is missing!");
        }

        $category = self::$categories[$key];

        $tree[] = $category;

        if ($category['parent'] > 0) {
            self::getTreeCategoryById($category['parent'], $tree);
        }

        return $tree;
    }

    public static function getAllCategories() : array
    {
        if (isset(self::$categories)) {
            return self::$categories;
        }

        $apiParams = [];

        self::$categories = ApiWpHelper::getData($apiParams, 'categories', true);

        return self::$categories;
    }

    public static function getTreeCategoryBySlug(string $slug, array &$tree = []) : array
    {
        if (! isset(self::$categories)) {
            self::getAllCategories();
        }

        $key = array_search($slug, array_column(self::$categories, 'slug'));

        if ($key === false) {
            throw new Exception("Category with id $slug is missing!");
        }

        $category = self::$categories[$key];

        $tree[] = $category;

        if ($category['parent'] > 0) {
            self::getTreeCategoryById($category['parent'], $tree);
        }

        return $tree;
    }


}