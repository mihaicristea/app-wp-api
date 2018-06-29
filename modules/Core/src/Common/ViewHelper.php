<?php

namespace Core\Common;

use Exception;

class ViewHelper
{
    public function renderWidget(array $params)
    {
        if (! isset($params['widget'], $params['method'])) {
            throw new Exception('Invalid params! (widget and method)');
        }

        $widget = FileHelper::getWidget($params['widget']);
        var_dump(new $widget($params)); die();
        new $widget($params);

    }
}