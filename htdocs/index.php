<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Frontend\Controller\GenericController;
use Core\Common\Cfg;
use Core\Common\Url;

try {

    Cfg::setCfg('../cfg/general.php');

    $cfg = Cfg::getCfg();

    define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $cfg['app_path']);

    new Url();

    new GenericController();


} catch (Exception $e) {
    echo $e->getMessage();
    //@TODO: handle exception
}