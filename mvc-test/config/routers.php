<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 16:01
 */
$cnf['administration']['namespace'] = 'Controllers\Admin';
$cnf['admin']['namespace'] = 'Controllers\Admin';
$cnf['administration']['controllers']['index']['to'] = 'index';
$cnf['administration']['controllers']['index']['methods']['new'] = '_new';
$cnf['administration']['controllers']['new']['to'] = 'create';
$cnf['*']['namespace'] = 'Controllers';
return $cnf;