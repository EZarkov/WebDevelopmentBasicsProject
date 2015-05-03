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
	private $_router = null;
	private $_dbConections = array();
	private $_session = null;

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
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}

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
		$this->_config = \GF\Config::getInstance();
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}
		$this->_frontController = \GF\FrontController::getInstance();

		if ($this->_router instanceof \GF\Routers\IRouter) {
			$this->_frontController->setRouter($this->_router);
		} else {
			if ($this->_router == 'JsonRPCRouter') {
				//TODO Fix when is ready json router
				$this->_frontController->setRouter(new DefaultRouter());
			} elseif ($this->_router == 'CLIRPCRouter') {
				//TODO Fix when is ready CLI router
				$this->_frontController->setRouter(new DefaultRouter());
			} else {
				$this->_frontController->setRouter(new DefaultRouter());
			}
		}
		$sess = $this->_config->app['session'];
			if($sess['autostart']){
				if ($sess['type'] == 'native'){
					$session = new \GF\Session\NativeSession($sess['name'], $sess['lifetime'], $sess['path'], $sess['domain'], $sess['secure']);
				}
				$this->setSession($session);

			}
		$this->_frontController->dispatch();
	}

	/**
	 * @param Session\ISession $session
	 */
	public function setSession(Session\ISession $session) {
		$this->_session = $session;
	}

	/**
	 * @return \GF\Session\ISession
	 */
	public function getSession() {
		return $this->_session;
	}

	public function getDBConnection($connection = 'default') {
		//Gataka  have mistake we always have connection because we have default value;
		if(!$connection){
			throw new \Exception ('No connection identifier provided.', 500);
		}
		if ($this->_dbConections[$connection]){
			return $this->_dbConections[$connection];
		}
		$cnf = $this->getConfig()->database;
		if(!$cnf[$connection]){
			throw new \Exception ('No connection identifier provided.', 500);
		}

		$db = new \PDO(
			$cnf[$connection]['connection_url'],
			$cnf[$connection]['username'],
			$cnf[$connection]['pass'],
			$cnf[$connection]['pdo_options']
			);
		$this->_dbConections[$connection] = $db;
		return $db;
	}

	/**
	 * @return \GF\App
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \GF\App();
			echo 'i am null<br>';
		} else {
			echo 'i am not null<br>';
		}

		return self::$_instance;
	}
}