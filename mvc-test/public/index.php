<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

include '../../mvc/App.php';
$app = \GF\App::getInstance();
//Run always first because this initialize all default configs.



$db= new \GF\DB\SimpleDB();
//$a = $db->prepare('SELECT * FROM user WHERE user_id = ?')->execute(array(1))->fetchAllAssoc();
//echo '<pre>' . print_r($a, true) . '</pre>';

$app->run();




$app->setRouter("AA");







