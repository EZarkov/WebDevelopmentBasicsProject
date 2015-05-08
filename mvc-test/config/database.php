<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 13:48
 */

$cnf['default']['connection_url'] = 'mysql:host=localhost;dbname=test';
$cnf['default']['username'] = 'root';
$cnf['default']['pass'] = '';
$cnf['default']['pdo_options'] [PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$cnf['default']['pdo_options'] [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

$cnf['dev_forum']['connection_url'] = 'mysql:host=localhost;dbname=dev_forum';
$cnf['dev_forum']['username'] = 'root';
$cnf['dev_forum']['pass'] = '';
$cnf['dev_forum']['pdo_options'] [PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$cnf['dev_forum']['pdo_options'] [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

return $cnf;