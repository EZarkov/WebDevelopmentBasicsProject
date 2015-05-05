<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 04.05.15
 * Time: 16:24
 */

namespace MVC;


class DefaultController {
	/**
	 * @var App
	 */
	public $app;
	/**
	 * @var View
	 */
	public $view;
	/**
	 * @var Config
	 */
	public $config;
	/**
	 * @var InputData|null
	 */
	public $input;



	public function __construct() {
		$this->app = App::getInstance();
		$this->view = View::getInstance();
		$this->input =InputData::getInstance();
		$this->config = $this->app->getConfig();
	}

	public function jsonResponse() {

	}
}