<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../mvc/App.php';
$app = \GF\App::getInstance();
$config = \GF\Config::getInstance();
$config->setConfigFolder('../config');

echo $config->app['test1'];
$app->run();

//https://youtu.be/bDWTlB4T7fc?list=PLjsqymUqgpST6BDlzkn7cztPXZYP-4kYD&t=873


/*
class Foo {

	private $data = false;


	public function __construct($id) {

		$data = db::getUser($id);
		$data->{'id'} = 1;
		$data->{'user'} = 'evst';
		$data->{'email'} = 'evst@asd.dd';
		$data->{'pass'} = 'pass';

		return $this;
	}


	public function __get($var) {
		if (isset($this->data->{$var})) {
			return $this->data->{$var};
		}

		return false;
	}

	public function __set($var, $value) {
		if ($var == 'id') {
			throw new Exception('cannot modify userid');
			return;
		}

		if (isset($this->data->{$var})) {
			$this->data->{$var} = $value;
			return true;
		}
		$this->data->{$var} = new StdClass();
		$this->data->{$var} = $value;
		return true;
	}

	public function __isset($var) {
		return isset($this->data->{$var});
	}

	public function save() {
		if ($this->data) {

			$data = $this->data;

			$id = $data->id;
			unset($data->id);

			db::updateUser($id, $data);
		}
	}
}



$user = new Foo($user_id);

$user->pass = 'new_pass';


$user->save();






