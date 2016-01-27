<?php

/**
 * Class Request, represent an URL request, with all its parameters
 */
class Request {

  public $_url;  // URL called by user
  
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
  }

  /**
   * @return user URL
   */
  function getURL() {
    return $this->_url;
  }
} 
