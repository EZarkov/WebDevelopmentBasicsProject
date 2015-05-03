<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 17:48
 */

$cnf['default_controller'] = 'index';
$cnf['default_method'] = 'main';
$cnf ['namespaces']['Controllers'] = '/home/evstati/dev/WebDevelopmentBasicsProject/mvc-test/controllers';
/*
$cnf['session']['autostart'] = true;
$cnf['session']['type']= 'native';
$cnf['session']['name']='_sess';
$cnf['session']['lifetime']=3600;
$cnf['session']['path']='/';
$cnf['session']['domain']='';
$cnf['session']['secure']=false;
*/
$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native';
$cnf['session']['name'] = '_sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
$cnf['session']['dbConnection'] = 'default';
$cnf['session']['dbTable'] = 'sessions';

return $cnf;