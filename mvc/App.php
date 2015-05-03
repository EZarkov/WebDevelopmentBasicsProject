<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 23.04.15
 * Time: 14:42
 */
namespace MVC;

use MVC\Routers\DefaultRouter;

include_once 'Loader.php';

class App {
	private static $_instance = null;
	private $_config = null;
	/**
	 * @var \MVC\FrontController
	 */
	private $_frontController = null;
	private $_router = null;
	private $_dbConections = array();
	/**
	 * @var Session\ISession
	 */
	private $_session;

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
		Loader::registerNamespace('MVC', dirname(__FILE__) . DIRECTORY_SEPARATOR);
		Loader::registerAutoload();
	}

	/**
	 * @param $path
	 * @throws \Exception
	 */
	public function setConfigFolder($path) {
		$this->_config->setConfigFolder($path);
	}

	/**
	 * @return \MVC\Config
	 */
	public function getConfigFolder() {
		return $this->_config->getConfigFolder();
	}

	/**
	 * @return \MVC\Config
	 */
	public function getConfig() {
		return $this->_config;

	}

	/**
	 *
	 */
	public function run() {
		$this->_config = \MVC\Config::getInstance();
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}
		$this->_frontController = \MVC\FrontController::getInstance();

		if ($this->_router instanceof \MVC\Routers\IRouter) {
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
		$session = false;
			if($sess['autostart']){
				if ($sess['type'] == 'native'){

					$session = new \MVC\Session\NativeSession($sess['name'], $sess['lifetime'], $sess['path'], $sess['domain'], $sess['secure']);
				} elseif ($sess['type'] == 'database'){
					$session = new \MVC\Session\DBSession(
						$sess['dbConnection'],
						$sess['name'],
						$sess['dbTable'],
						$sess['lifetime'],
						$sess['path'],
						$sess['domain'],
						$sess['secure']);
				} else {
					throw new \Exception ('No valid session config.', 500);
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
	 * @return \MVC\Session\ISession
	 */
	public function getSession() {
		return $this->_session;
	}

	public function getDBConnection($connection = 'default') {
		//Gatakka  have mistake we always have connection because we have default value;
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
	 * @return \MVC\App
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \MVC\App();
		}

		return self::$_instance;
	}

	public function __destruct() {
		if($this->_session != null){
			$this->_session->saveSession();
		}
	}
}