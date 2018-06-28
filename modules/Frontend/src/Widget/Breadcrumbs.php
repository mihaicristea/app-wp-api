<?php

namespace Frontend\Widget;

use Core\Common\AbstractWidget;
use Core\Common\View;

class Breadcrumbs extends AbstractWidget
{
    public function renderWidget()
    {
        new View('frontend/widgets/breadcrumbs', $params);
    }
}