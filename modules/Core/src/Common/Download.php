<?php

namespace Core\Common;

use Exception;

class Download
{
    private $url = null;
    private $params = [];

    public function __construct($url, array $params = array())
    {
        $this->url = $url;

        if (count($params)) {
            $this->params = $params;
        }
    }

    private function get()
    {
        $ch = \curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        if (count($this->params) > 0) {

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($this->params));
        }

        $result = curl_exec($ch);

        if ($result === false) {
            throw new Exception("Error downloading {$this->url} " . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }

    public function exportJson($arrayFormat = false)
    {
        $data = $this->get();

        if ($data !== false) {
            return json_decode($data, $arrayFormat);
        }

        return false;
    }

}