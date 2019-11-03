<?php
//phpinfo();
//exit;
//spl_autoload_register(function ($MyApi){
//    include './classes/' . $MyApi . '.php';
//});
//require __DIR__.'./vendor/autoload.php';
include_once './vendor/autoload.php';

use Roowix\Podkur\Connect;
use Roowix\Podkur\Api;
use \Roowix\Podkur\DataBaseConnect;

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$tableName = 'students';

$dbconn = new DataBaseConnect();

$api = new Api($uri, $method, $tableName, $dbconn);
$api->run();

//$studentsConnect = new Connect("host=localhost port=5432 dbname=postgres user=postgres password=iebdkst");
//$dbconn = $studentsConnect->getConnect();
//
//$api = new MyApi($_SERVER['REQUEST_METHOD'], 'students');
//$api->run($dbconn);