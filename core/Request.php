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
    if (count(Router::$routes) >= 2) {
      // Update controller
      $controller = Router::$routes[1];
    }

    // Action is also specified
    if (count(Router::$routes) >= 3) {
      // Update action
      $action = Router::$routes[2];
    }

    // Parameters are given
    if (count(Router::$routes) == 4) {
      // Update parameters
      $params = Router::$routes[3];
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
