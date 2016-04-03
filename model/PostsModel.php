<?php
class PostsModel extends Model {
  /**
   * Find all entry in table posts order by date decrement
   * @param [in] $param array containing filter
   */
  public function find($param = 0) {
    $sql = 'SELECT *, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr FROM '.$this->_table.' ';

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

    // Full date with seconds is needed here in case two post are uploaded 
    // in the same minute. (Assuming that two posts cannot be added in the
    // same second)
    $sql .= ' ORDER BY STR_TO_DATE(date, \'%Y-%m-%d %H:%i:%s\') DESC';

    $rq = $this->_db->prepare($sql);
    $rq->execute();
    return $rq->fetchAll(PDO::FETCH_OBJ);
  }
}
