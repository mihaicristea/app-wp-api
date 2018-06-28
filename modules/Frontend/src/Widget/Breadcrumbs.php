<?php

namespace Frontend\Widget;

use Core\Common\AbstractWidget;
use Core\Common\View;
use Exception;

class Breadcrumbs extends AbstractWidget
{

    public function getPostBreadcrumbs(array $params)
    {
        if (! isset($params['post'])) {
            throw new Exception("Param post missing!");
        }


        $post = $params['post'];
        $apiParams = [
            'id' => $post->id
        ];

        return ApiWpHelper::getData($apiParams, $this->type);

//        $breadcrumbs = array_reverse($breadcrumbs);
//
//        $out = array();
//
//        if (! empty($prepend)) {
//            foreach ($prepend as $p) {
//                $out[] = $p;
//            }
//        }
//
//        $url = '';
//        foreach ($breadcrumbs as $i => $breadcrumb) {
//
//            if ($i == 0) {
//                $url .= $breadcrumb['url'];
//            } else {
//                $url .= '/' .$breadcrumb['url'];
//            }
//
//            $out[] = array(
//                'url' => $url,
//                'title' => $breadcrumb['title'],
//            );
//        }
//
//        return $out;

    }
}