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

		$val = new \MVC\Validation();

		$val->setRule('url', 'http://gong.bg/')->setRule('minLength', 'http://gong.bg/', 5);
		var_dump($val->validate());


		/*
		$view = \MVC\View::getInstance();
		$view->title = 'Dev Forum';
		$view->appendToLayout('body', 'body');
		$view->display('layouts/default');
		*/
	}
}