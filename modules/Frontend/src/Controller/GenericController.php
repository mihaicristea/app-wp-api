<?php

namespace Frontend\Controller;

use Exception;
use Core\Common\View;
use Core\Common\Cfg;
use Core\Common\Download;

class GenericController
{
    private $url;

    public function __construct()
    {

        if (isset($_GET['p'])) {

            $this->url = explode('/', $_GET['p']);
            $this->index();

        } else {
            new HomepageController();
        }
    }

    private function index()
    {

        if (count($this->url) > 0) {
            rsort($this->url);
        }

        $slug = $this->url[0];

        $cfg = Cfg::getCfg();

        foreach ($cfg['routing-type'] as $type => $apiUrl) {
            switch ($type) {
                case 'posts':

                    $params = ['slug' => $slug];
                    $url = $cfg['wp-api-url'] . $apiUrl . '?' . http_build_query($params);
                    $download = new Download($url);
                    $data = $download->exportJson();

                    if (! is_array($data)) {
                        throw new Exception('API response is not array!');
                    }

                    if (count($data) > 1) {
                        throw new Exception('API response must have only 1 record!');
                    }

                    return $this->article();

                    break;
            }
        }

    }

    private function article()
    {
        new View('frontend/article');
        die('article');
    }

    private function category()
    {}

    private function page()
    {}

}