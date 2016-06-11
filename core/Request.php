<?php

/**
 * Class Request, represent an URL request, with all its parameters
 */
class Request {

  public $url = "";  // URL called by user
  public $page = 1;
  public $prefix = false;

  /**
   * Ctor
   * Initialize url with routes created in config.php
   */
  function __construct() {
    // Each pages can have pagination.
    if (isset($_GET['page'])) {
      if (is_numeric($_GET['page'])) {
        if ($_GET['page'] > 0) {
          $this->page = round($_GET['page']);
        }
      }
    }

    $controller = "posts";
    $action = "index";
    $params = "news";

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
    $this->url = $controller.'/'.$action.'/'.$params;     
  }

  /**
   * @return user URL
   */
  function getURL() {
    return $this->url;
  }
} 
