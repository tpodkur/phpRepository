<?php

//spl_autoload_register(function ($MyApi){
//    include './classes/' . $MyApi . '.php';
//});
//require __DIR__.'./vendor/autoload.php';
include_once './vendor/autoload.php';
use Roowix\Podkur\MyApi;

$api = new MyApi();
$api->run();

//$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=iebdkst");
//$result = pg_query($dbconn, "SELECT * FROM students");
//
//$students = array();
//
//while ($row = pg_fetch_row($result))
//{
//    $students[] = array("id" => $row[0], "firstname" => $row[1], "lastname" => $row[2]);
//}
//
//echo json_encode($students);