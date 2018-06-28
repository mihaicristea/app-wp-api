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
        new $widget($params);

    }
}