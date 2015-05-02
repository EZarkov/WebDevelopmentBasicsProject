<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

include '../../mvc/App.php';
$app = \GF\App::getInstance();

$app->setRouter("AA");

$app->run();

