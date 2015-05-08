<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 05.05.15
 * Time: 13:16
 */

namespace Controllers\Admin;


use Controllers\DefaultController;

class User extends DefaultController{
	public function main(){


		$view=$this->view;
		$data = ['system' => [
			'title'=> ['category_id'=>1],


		]];


		$view->title = 'Dev Forum';
		$view->data = $data;

		$view->appendToLayout('body', 'home');
		$view->display('layouts/default');
	}
	public function delete() {
			echo 'delete user';
		}
}