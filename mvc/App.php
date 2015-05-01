<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 14:42
 */
namespace GF;
use GF\Routers\DefaultRouter;

include_once 'Loader.php';

class App {
	private static $_instance = null;
	private $_config = null;
	/**
	 * @var \GF\FrontController
	 */
	private $_frontController = null;
	private $_router =  null;

	/**
	 * @return null
	 */
	public function getRouter() {
		return $this->_router;
	}

	/**
	 * @param null $router
	 */
	public function setRouter($router) {
		$this->_router = $router;
	}


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
		return $this->_config->getConfigFolder();
	}

	/**
	 * @return \GF\Config
	 */
	public function getConfig() {
		return $this->_config;

	}

	/**
	 *
	 */
	public function run() {
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}
		$this->_frontController = \GF\FrontController::getInstance();


		if($this->_router instanceof \GF\Routers\IRouter){
			$this->_frontController->setRouter($this->_router);
		} else if ($this->_router == 'JsonRPCRouter'){
			//TODO Fix when is ready json router
			$this->_frontController->setRouter(new DefaultRouter());
		} elseif ($this->_router == 'CLIRPCRouter'){
			//TODO Fix when is ready CLI router
			$this->_frontController->setRouter(new DefaultRouter());
		} else{
			$this->_frontController->setRouter(new DefaultRouter());
		}
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