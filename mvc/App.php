<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 14:42
 */
namespace GF;
include_once 'Loader.php';

class App {
	private static $_instance = null;
	private $_config = null;
	/**
	 * @var \GF\FrontController
	 */
	private $_frontController = null;


	private function __construct() {
		Loader::registerNamespace('GF', dirname(__FILE__) . DIRECTORY_SEPARATOR);
		Loader::registerAutoload();
		$this->_config = \GF\Config::getInstance();

	}

	/**
	 * @param $path
	 * @throws \Exception
	 */
	public function setConfigFolder($path) {
		$this->_config->setConfigFolder($path);
	}

	/**
	 * @return \GF\Config
	 */
	public function getConfigFolder() {
		$this->_config->getConfigFolder();
	}

	/**
	 * @return \GF\Config
	 */
	public function getConfig() {
		$this->_config;
	}

	/**
	 *
	 */
	public function run() {
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}
		$this->_frontController = \GF\FrontController::getInstance();
		$this->_frontController->dispatch();
	}

	/**
	 * @return \GF\App
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \GF\App();
		}

		return self::$_instance;
	}
}