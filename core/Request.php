<?php

/**
 * Class Request, represent an URL request, with all its parameters
 */
class Request {

  public $_url;  // URL called by user
  public $_page = 1;
  
  /**
   * Ctor
   * Initialize _url with user URL if $_SERVER['PATH_INFO'] is set
   * otherwise _url is left empty ""
   */
  function __construct() {
    if (!empty($_SERVER['PATH_INFO'])) {
      $this->_url = $_SERVER['PATH_INFO'];
    } else {
      $this->_url = "";
    }
    if (isset($_GET['page'])) {
      if (is_numeric($_GET['page'])) {
        if ($_GET['page'] > 0) {
          $this->_page = round($_GET['page']);
        }
      }
    }
  }

  /**
   * @return user URL
   */
  function getURL() {
    return $this->_url;
  }
} 
