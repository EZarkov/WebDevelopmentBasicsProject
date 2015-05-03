<?php
mb_internal_encoding("UTF-8");
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include '../../mvc/App.php';

$app = \GF\App::getInstance();
//Run always first because this initialize all default configs.
$app->run();
$app->getSession()->counter += +1;
echo $app->getSession()->counter . "<br>";

