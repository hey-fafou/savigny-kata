<?php
/**
 * class Model
 * @brief Base class model
 */
class Model {

  static $connections = array();

  public $_dbName = 'default';
  public $_table = false;
  public $_db;

  /**
   * Ctor
   * Retrieve config for database connection, and
   * create PDO object after connection to database
   */
  function __construct() {
    // Get correct table for each child class
    // Example: PostsModel child class has table posts so we have to 
    // delete 'Model' and lower case the rest.
    if ($this->_table === false) {
      $this->_table = strtolower(str_replace("Model", "", get_class($this)));
    }

    $dbConfig = Config::$databases[$this->_dbName];

    // Load only one connection
    if (isset(Model::$connections[$this->_dbName])) {
      $this->_db = Model::$connections[$this->_dbName];
      return true;
    }

    // If database connection does not exit, try
    // to make a new one.
    try {
      // utf8 connection
      $pdo = new PDO('mysql:host='.$dbConfig['host'].'; 
                      dbname='.$dbConfig['database'].';', 
                      $dbConfig['login'], 
                      $dbConfig['password'],
                      array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      // Saving the connection
      Model::$connections[$this->_dbName] = $pdo;
      $this->_db = $pdo; 
    } catch(PDOException $e) {
      if (Config::debug >= 1) {
        die($e->getMessage());
      } else {
        die('Unable to connect database.');
      }
    }
  }

  /**
   * Find all entry in _table according to some filters.
   * @param [in] $param array containing filters
   */
  public function find($param = 0) {
    $sql = 'SELECT * FROM '.$this->_table.' ';

    // Construction of filters
    if (isset($param['filters'])) {
      $sql .= 'WHERE ';

      // When user has a specific request to make 
      if (!is_array($param['filters'])) {
        $sql .= $param['filters'];
      } else {
        $cond = array();
        // Foreach filter of type key => value
        foreach($param['filters'] as $k=>$v) {
          // Need to put "" if value is not numeric
          if (!is_numeric($v)) {
            $v = '"'.mysql_escape_string($v).'"';
          }
          // Adding each conditions
          $cond[] = "$k=$v";
        }
        // separating conditions in request with AND
        $sql .= implode(' AND ', $cond);
      }
    }
    $rq = $this->_db->prepare($sql);
    $rq->execute();
    return $rq->fetchAll(PDO::FETCH_OBJ);
  }
}
