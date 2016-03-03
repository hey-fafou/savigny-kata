<?php
class Model {

  static $connections = array();

  public $_dbName = 'default';
  public $_table = false;
  public $_db;

  function __construct() {
    $dbConfig = Config::$databases[$this->_dbName];
    if (isset(Model::$connections[$this->_dbName])) {
      $this->_db = Model::$connections[$this->_dbName];
      return true;
    }
    try {
      $pdo = new PDO('mysql:host='.$dbConfig['host'].'; 
                      dbname='.$dbConfig['database'].';', 
                      $dbConfig['login'], 
                      $dbConfig['password'],
                      array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
      Model::$connections[$this->_dbName] = $pdo;
     $this->_db = $pdo; 
    } catch(PDOException $e) {
      if (Config::debug >= 1) {
        die($e->getMessage());
      } else {
        die('Unable to connect database.');
      }
    }

    if ($this->_table === false) {
      $this->_table = strtolower(str_replace("Model", "", get_class($this)));
    }
  }

  public function find($param) {
    $sql = 'SELECT * FROM '.$this->_table.' ';
    if (isset($param['conditions'])) {
      $sql .= 'WHERE '.$param['conditions'];
    }
    $rq = $this->_db->prepare($sql);
    $rq->execute();
    return $rq->fetchAll(PDO::FETCH_OBJ);
  }
}
