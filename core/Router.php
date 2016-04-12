<?php

/**
 * Global class Router that won't be instanciated.
 */
class Router {
  static $routes = array();

  /**
   * Parse a given url
   * @param [in] $url url to be parsed
   * @param [out] $request request in which we'll write url parameters
   */
  static function parse($url, $request) {
    $url = trim($url, '/');   // Erasing '/' in beginning and end of URL
    $args = explode('/', $url);   // Retrieving args between '/'

    // Adding first in $request the controller and the action
    $request->controller = $args[0];
    $request->action = $args[1];

    // Then adding other parameters
    $request->args = array_slice($args, 2);
  }

  static function connect($pattern, &$url) {
    $r = array();

    $pattern = '/'.str_replace('/', '\/', $pattern).'/';

    if (preg_match($pattern, $url, $match)) {
      self::$routes[] = $match[1];
      $url = trim(str_replace($match[1], '', $url), '/');
    } 
  }
} 
