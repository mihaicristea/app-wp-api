<?php

namespace Frontend\Controller;

use Core\Common\View;
use Exception;

class ArticleController extends AbstractController
{
    protected $type = 'posts';

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
            new View('frontend/articles/article', ['mix' => 'cool']);
            die('article');
        }
    }

}