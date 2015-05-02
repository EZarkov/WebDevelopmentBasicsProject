<?php
/**
 * Created by PhpStorm.
 * User: evstati
 * Date: 02.05.15
 * Time: 17:03
 */

namespace GF\DB;


class SimpleDB {

	protected $_connection = 'default';
	private $_db = null;

	private $_stmt = null;
	private $_params = array();
	private $_sql;

	/**
	 * @param null $connection
	 * @throws \Exception
	 */
	public function __construct($connection = null) {
		//TODO I have some problems with Gatakas logic
		if ($connection instanceof \PDO) {
			$this->_db = $connection;
		} elseif ($connection != null) {
			$this->_db = \GF\App::getInstance()->getDBConnection($connection);
			$this->_connection = $connection;
		} else {
			$this->_db = \GF\App::getInstance()->getDBConnection($this->_connection);
		}
	}

	/**
	 * @param $sql
	 * @param array $params
	 * @param array $pdoOptions
	 * @return \GF\DB\SimpleDB
	 */
	public function prepare($sql, $params = array(), $pdoOptions = array()){
		$this->_stmt = $this->_db->prepare($sql, $pdoOptions);
		$this->_params = $params;
		$this->_sql = $sql;
		return $this;
	}

	/**
	 * @param array $params
	 * @return  \GF\DB\SimpleDB
	 */
	public function execute($params = array()) {
		if($params){
			$this->_params = $params;
		}
		$this->_stmt->execute($this->_params);
		return $this;
	}

	public function fetchAllAssoc() {
		return $this->_stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function fetchRowAssoc() {
		return $this->_stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function fetchAllNum() {
		return $this->_stmt->fetchAll(\PDO::FETCH_NUM);
	}

	public function fetchRowNum() {
		return $this->_stmt->fetch(\PDO::FETCH_NUM);
	}

	public function fetchAllObj() {
		return $this->_stmt->fetchAll(\PDO::FETCH_OBJ);
	}

	public function fetchRowObj() {
		return $this->_stmt->fetch(\PDO::FETCH_OBJ);
	}

	public function fetchAllColumn($column) {
		return $this->_stmt->fetchAll(\PDO::FETCH_COLUMN, $column);
	}

	public function fetchRowColumn($column) {
		return $this->_stmt->fetch(\PDO::FETCH_COLUMN, $column);
	}

	public function fetchAllClass($class) {
		return $this->_stmt->fetchAll(\PDO::FETCH_CLASSN, $class);
	}

	public function fetchRowClass($class) {
		return $this->_stmt->fetch(\PDO::FETCH_CLASSN, $class);
	}

	public function getLstInsertId() {
		return $this->_db->lastInsertId();
	}

	public function getAffectedRows() {
		return $this->_stmt->rowCount();
	}

	public function getSTMT() {
		return $this->_stmt;
	}
}