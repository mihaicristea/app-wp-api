<?php

namespace Frontend\Widget;

use Core\Common\AbstractWidget;
use Core\Common\View;
use Exception;

class Pagination extends AbstractWidget
{
    public function renderWidget(array $params)
    {
        if (! isset($params['posts']) || ! is_array($params['posts'])) {
            throw new Exception("Param posts missing!");
        }

        return View::renderWidget('frontend/widgets/pagination', $params);
    }
}