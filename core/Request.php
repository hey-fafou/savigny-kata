<?php

/**
 * Class Request, represent an URL request, with all its parameters
 */
class Request {

  public $_url = "";  // URL called by user
  public $_page = 1;

  /**
   * Ctor
   * Initialize _url with routes created in config.php
   */
  function __construct() {
    // Each pages can have pagination.
    if (isset($_GET['page'])) {
      if (is_numeric($_GET['page'])) {
        if ($_GET['page'] > 0) {
          $this->_page = round($_GET['page']);
        }
      }
    }

    $controller = "home";
    $action = "index";
    $params = "";

    // Controller is specified
    if (isset(Router::$routes['controller'])) {
      // Update controller
      $controller = Router::$routes['controller'];
    }

    // Action is also specified
    if (isset(Router::$routes['action'])) {
      // Update action
      $action = Router::$routes['action'];
    }

    // Parameters are given
    if (isset(Router::$routes['parameters'])) {
      // Update parameters
      $params = Router::$routes['parameters'];
    }
    $this->_url = $controller.'/'.$action.'/'.$params;     
  }

  /**
   * @return user URL
   */
  function getURL() {
    return $this->_url;
  }
} 
