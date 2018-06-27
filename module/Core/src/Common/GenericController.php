<?php

namespace Core\Common;

use Exception;

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

        try {

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

        } catch (Exception $e) {
            //@TODO: handle exception
        }

    }

    private function article()
    {
        die('article');
    }

    private function category()
    {}

    private function page()
    {}

}