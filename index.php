<?php

spl_autoload_register(function ($MyApi){
    include './classes/' . $MyApi . '.php';
});

$api = new MyApi();
$api->run();
