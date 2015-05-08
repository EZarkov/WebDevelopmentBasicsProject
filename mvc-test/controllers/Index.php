<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 16:04
 */

namespace Controllers;



use Models\Storage_Users;

class Index extends DefaultController {



	public function main() {


//		$val = new \MVC\Validation();
//
//		$val->setRule('url', 'http://gong.bg/')->setRule('minLength', 'http://gong.bg/', 5);
//		var_dump($val->validate());

var_dump($_SESSION);
		$view = $this->view;

		$data = ['system' => [
			'title' => ['category_id' => 1],
		]];


		$view->title = 'Dev Forum';
		$view->data = $data;
		$view->appendToLayout('body', 'body');
		$view->display('layouts/default');

	}

	public function login() {

		$userId = Storage_Users::loginUser('test', '1234');
		var_dump($userId);
		if ($userId) {
			$_SESSION['user_id'] =(int) $userId;

		} else {
			
		}
		var_dump($_SESSION);
header('Location: http://dev-forum.com');

	}
}