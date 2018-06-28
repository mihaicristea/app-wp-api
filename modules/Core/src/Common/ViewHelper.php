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

        $widget = new $widget();

        if (! method_exists($widget, $params['method'])) {
            throw new Exception("Invalid method! ({$params['method']})");
        }

        $widget->$params['method'];

    }
}