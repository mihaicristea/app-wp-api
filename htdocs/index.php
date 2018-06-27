<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Common\GenericController;
use Core\Common\Cfg;






try {

    Cfg::setCfg('../cfg/general.php');

    $cfg = Cfg::getCfg();

    define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $cfg['app_path']);

    new GenericController();



//    $url = 'http://localhost/wordpress/index.php/wp-json/wp/v2/posts';
//
//    $download = new Download($url);
//
//    $data = $download->exportJson();
//
//    print_r($data);

} catch (Exception $e) {
    //@TODO: handle exception
}