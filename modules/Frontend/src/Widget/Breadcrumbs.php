<?php

namespace Frontend\Widget;

use Core\Common\View;

class Breadcrumbs
{
    public function __construct()
    {
        $params = [];
        new View('frontend/articles/text-article', $params);
    }
}