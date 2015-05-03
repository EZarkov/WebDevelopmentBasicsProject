<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 03.05.15
 * Time: 13:42
 */

namespace MVC\Session;


class DBSession extends \MVC\DB\SimpleDB implements \MVC\Session\ISession {

	//TODO Ask Momchil: Use extends SimpleDB or create new DB obj

	private $_sessionName;
	private $_tableName;
	private $_lifetime;
	private $_path;
	private $_domain;
	private $_secure;
	private $_sessionId = null;
	private $_sessionData = array();
	 public function __construct($dbConnection, $name, $tableName = 'sessons', $lifetime = 3600, $path = null, $domain = null, $secure = false) {
		 parent::__construct($dbConnection);
		 $this->_tableName = $tableName;
		 $this->_sessionName = $name;
		 $this->_lifetime = $lifetime;
		 $this->_path = $path;
		 $this->_domain = $domain;
		 $this->_secure = $secure;
		 $this->_sessionId = $_COOKIE[$name];

		 //TODO prefer make cron not this code.
		 if (rand(0, 50) == 1){
			 $this->_garbageCollector();
		 }

		 if (strlen($this->_sessionId) < 32){
			 $this->_startNewSession();
		 } else if (!$this->_validateSession()){
			 $this->_startNewSession();
		 }
	}

	private function _validateSession(){
		if ($this->_sessionId){
			$data = $this->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE sessid = ? AND valid_until >= ?',
				array($this->_sessionId, time()))->execute()->fetchAllAssoc();
			if(is_array($data) && count($data) == 1 && $data[0]){
				$this->_sessionData = unserialize($data[0]['sess_data']);
				return true;
			}
		}
		return false;
	}

	private function _startNewSession(){

		$this->_sessionId = md5(uniqid('gf', true));
		$this->prepare('INSERT INTO ' . $this->_tableName . '(sessid, valid_until) VALUES(?,?)',
			array($this->_sessionId, (time()+ $this->_lifetime )))->execute();
		setcookie($this->_sessionName, $this->_sessionId, (time()+ $this->_lifetime ), $this->_path, $this->_domain, $this->_secure, true);
}
	public function __get($name) {
		return $this->_sessionData[$name];
	}

	public function __set($name, $value) {
		$this->_sessionData[$name] = $value;
	}

	public function destroySession() {
		if ($this->_sessionId){
			$this->prepare('DELETE FROM ' . $this->_tableName . ' WHERE sessid = ?', array($this->_sessionId))->execute();
		}
	}

	public function getSessionID() {
		return $this->_sessionId;
	}

	public function saveSession() {
		if($this->_sessionId){
			$this->prepare('UPDATE ' . $this->_tableName . ' SET sess_data = ?, valid_until = ? WHERE sessid = ?',
				array(serialize($this->_sessionData), (time() + $this->_lifetime), $this->_sessionId))->execute();

			setcookie($this->_sessionName, $this->_sessionId, (time()+ $this->_lifetime ), $this->_path, $this->_domain, $this->_secure, true);
		}
	}

	private function _garbageCollector (){
		$this->prepare('DELETE FROM ' . $this->_tableName . ' WHERE valid_until < ?', array(time()))->execute();
	}
}