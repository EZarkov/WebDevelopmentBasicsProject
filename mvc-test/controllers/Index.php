<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 16:04
 */

namespace Controllers;



class Index {

	public function main(){

		$view = \MVC\View::getInstance();
		$view->title = 'Dev Forum';
		$view->appendToLayout('body', 'body');
		$view->display('layouts/default');

	}
}