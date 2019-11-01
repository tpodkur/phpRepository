<?php
//phpinfo();
//exit;
//spl_autoload_register(function ($MyApi){
//    include './classes/' . $MyApi . '.php';
//});
//require __DIR__.'./vendor/autoload.php';
include_once './vendor/autoload.php';
use Roowix\Podkur\MyApi;

$api = new MyApi();
$api->run();