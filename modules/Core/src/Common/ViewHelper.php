<?php

namespace Core\Common;

use Exception;
use Frontend\Controller\ArticleController;

class ViewHelper
{
    public function renderWidget(array $params)
    {
        if (! isset($params['widget'], $params['method'])) {
            throw new Exception('Invalid params! (widget and method)');
        }

        $file = FileHelper::prepareWidgetFile($params['widget']);

        var_dump($file); die();

        if (file_exists($file)) {



        } else {
            throw new Exception("File ({$params['widget']}) not found!");
        }

        new View('Frontend/Breadcrumbs', $params);
    }
}