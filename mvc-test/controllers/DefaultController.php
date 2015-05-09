<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 05.05.15
 * Time: 17:05
 */

namespace Controllers;
use MVC\App;
use MVC\View;
use MVC\InputData;
use MVC\DB\SimpleDB;
use MVC\Validation;
use Models\Storage_Users;
class DefaultController {
	/**
	 * @var \MVC\App
	 */
	public $app;
	/**
	 * @var \MVC\View
	 */
	public $view;
	/**
	 * @var \MVC\Config
	 */
	public $config;
	/**
	 * @var \MVC\InputData|null
	 */
	public $input;

	const POST_TYPE_QUESTION = 0;
	const POST_TYPE_ANSWER = 1;



	public function __construct() {
		$this->app = App::getInstance();
		$this->view = View::getInstance();
		$this->input = InputData::getInstance();
		$this->config = $this->app->getConfig();

		Storage_Users::setDbAdapter(new SimpleDB('dev_forum'));
		Storage_Users::setValidator(new Validation());


	}

}