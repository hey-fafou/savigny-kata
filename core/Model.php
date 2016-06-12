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
  public $_primaryKey = 'id';

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
      if (Config::$debug >= 1) {
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
    $sql = 'SELECT ';

    // Select field by field
    if (isset($param['fields'])) {
      if (is_array($param['fields'])) {
        $fields = array();
        foreach ($param['fields'] as $k => $v) {
          foreach ($v as $field) {
            $fields[] = $k.'.'.$field.' AS '.substr($k, 0, -1).'_'.$field;
          }
        }
        $sql .= implode(', ', $fields);
      } else {
        // If only one field is given
        $sql .= $param['fields'];
      }
    } else {
      // If no fields are given, selecting all
      $sql .= '*';
    }

    // Select from the table
    $sql .= ' FROM '.$this->_table.' ';

    // Join table if set.
    if (isset($param['joins'])) {
      foreach ($param['joins'] as $k => $v) {
        $sql .= 'INNER JOIN '.$k.' ON '.$k.'.'.$v.' = '.$this->_table.'.'.$this->_primaryKey.' ';
      }
    }

    // Construction of filters
    if (isset($param['filters'])) {
      $sql .= 'WHERE ';

      // When user has a specific request to make 
      if (!is_array($param['filters'])) {
        $sql .= $param['filters'];
      } else {
        $cond = array();
        // Foreach filter of type key => value
        foreach ($param['filters'] as $table => $filters) {
          foreach ($filters as $k => $v) {
            // Need to put "" if value is not numeric
            if (!is_numeric($v)) {
              $v = '"'.mysql_escape_string($v).'"';
            }
            // Adding each conditions
            $cond[] = "$table.$k=$v";
          }
        }
        // separating conditions in request with AND
        $sql .= implode(' AND ', $cond);
      }
    }

    // Sorting column that are requested
    if (isset($param['sort'])) {
      // If several column to sort are given
      if (is_array($param['sort'])) {
        $sql .= ' ORDER BY '.implode(', ', $param['sort']);
      } else {
        // If only one column to sort is given
        $sql .= ' ORDER BY '.$param['sort'];
      }
    }

    // Limit on the number of entry to render
    if (isset($param['limit'])) {
      // If offset is given
      if (is_array($param['limit'])) {
        $sql .= ' LIMIT '.implode(', ', $param['limit']);
      } else {
        $sql .= ' LIMIT 0, '.$param['limit'];
      }
    }

    debug($sql);
    $rq = $this->_db->prepare($sql);
    $rq->execute();
    return $rq->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * Find first entry in _table that matches the request
   * @param [in] $param array containing filters
   */
  public function findFirst($param = 0) {
    return current($this->find($param));
  }

  /**
   * Count number of entry in _table that matches the request
   * @param [in] $param array containing filters
   */
  public function findCount($param = 0) {
    $r = $this->findFirst(array(
      'fields' => 'COUNT('.$this->_primaryKey.') AS count',
      'filters' => $param
    ));
    return $r->count;
  }

  public function delete($id) {
    $sql = "DELETE FROM $this->_table WHERE $this->_primaryKey = $id";
    $this->_db->query($sql);
    return true;
  }

  public function save($data) {
    $sql = "";
    $fields = array();
    $d = array();

    foreach($data as $k => $v) {
      $fields[] = "$k=:$k";
      $d[":$k"] = $v;
    }

    if (isset($data['id']) && !empty($data['id'])) {
      $key = $data['id'];
      unset($data['id']);
      $sql = 'UPDATE '.$this->_table.' SET '.implode(',', $fields).' WHERE '.$this->_primaryKey.'='.$key;
    } else {
      $sql = 'INSERT INTO '.$this->_table.' SET '.implode(',', $fields);
    }

    $rq = $this->_db->prepare($sql);
    $rq->execute($d);
    return $this->_db->lastInsertId();
  }
}
