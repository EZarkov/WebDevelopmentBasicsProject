<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 16:04
 */

namespace Controllers;



class Index extends \MVC\DefaultController {

	public function main (){

		$this->app->displayError(556);
		\MVC\App::getInstance()->displayError(404);
die;
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