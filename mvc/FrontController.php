<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 27.04.15
 * Time: 13:40
 */

namespace MVC;


class FrontController {
	private static $_instance = null;
	private $_ns = null;
	private $_controller = null;
	private $_method = null;
	/**
	 * @var \MVC\Routers\IRouter
	 */
	private $_router = null;

	/**
	 * @return \MVC\Routers\IRouter
	 */
	public function getRouter() {
		return $this->_router;
	}

	/**
	 * @param Routers\IRouter $router
	 */
	public function setRouter(Routers\IRouter $router) {
		$this->_router = $router;
	}

	private function __construct() {

	}

	public function dispatch() {
		if ($this->_router == null) {
			throw new \Exception ('No valid router found.', 500);
		}

		$uri = $this->_router->getURI();
		$routers = \MVC\App::getInstance()->getConfig()->routers;
		$rc = null;
		if (is_array($routers) && count($routers) > 0) {
			foreach ($routers as $key => $value) {
				if (strpos($uri, $key) === 0
					&& (strpos($uri, $key . '/') === 0 || $uri == $key)
					&& $value['namespace']
				) {
					$this->_ns = $value['namespace'];
					$uri = substr($uri, strlen($key) + 1);
					$rc = $value;
					break;
				}
			}

		} else {
			throw new \Exception('Default route is missing', 500);
		}
		if ($this->_ns == null && $routers['*']['namespace']) {
			$this->_ns = $routers['*']['namespace'];
			$rc = $routers['*']['controllers'];
		} elseif ($this->_ns == null && !$routers['*']['namespace']) {
			throw new \Exception('Default route is missing', 500);
		}

		$params = explode('/', $uri);
		$input = \MVC\InputData::getInstance();
		if ($params[0]) {
			$this->_controller = strtolower($params[0]);
			if ($params[1]) {

				$this->_method = strtolower($params[1]);
				unset($params[0], $params[1]);
				$input->setGet(array_values($params));

			} else {

				$this->_method = $this->getDefaultMethod();
			}
		} else {
			$this->_controller = $this->getDefaultController();
			$this->_method = $this->getDefaultMethod();
		}

		if (is_array($rc) && $rc['controllers']) {
			if ($rc['controllers'][$this->_controller]['methods'][$this->_method]) {
				$this->_method = strtolower($rc['controllers'][$this->_controller]['methods'][$this->_method]);
			}
			if (isset($rc['controllers'][$this->_controller]['to'])) {
				$this->_controller = strtolower($rc['controllers'][$this->_controller]['to']);
			}
		}

		$input->setPost($this->_router->getPost());
		//TODO fixit
		$f = $this->_ns . '\\' . ucfirst($this->_controller);
		$newController = new $f();

		$newController->{$this->_method}();

	}

	public function getDefaultController() {
		$controller = \MVC\App::getInstance()->getConfig()->app['default_controller'];
		if ($controller) {
			return strtolower($controller);
		}

		return 'index';
	}

	public function getDefaultMethod() {
		$method = \MVC\App::getInstance()->getConfig()->app['default_method'];

		if ($method) {
			return strtolower($method);
		}

		return 'index';
	}

	/**
	 * @return \MVC\FrontController
	 */
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \MVC\FrontController();
		}

		return self::$_instance;
	}
}