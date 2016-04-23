<?php

/**
 * Global class Router that won't be instanciated.
 */
class Router {
  static $routes = array();
  static $prefixes = array();

  /**
   * Associate an url key word to a prefix.
   * @param [in] $key word
   * @param [in] $prefix redirection
   */
  static function setPrefix($key, $prefix) {
    self::$prefixes[$key] = $prefix;
  }

  /**
   * Parse a given url
   * @param [in] $url url to be parsed
   * @param [out] $request request in which we'll write url parameters
   */
  static function parse($url, $request) {
    $url = trim($url, '/');   // Erasing '/' in beginning and end of URL
    $args = explode('/', $url);   // Retrieving args between '/'

    // Adding prefix if isset in Router::$routes
    if (isset(self::$routes['prefix'])) {
      $k = self::$routes['prefix'];
      $request->prefix = self::$prefixes[$k];
    }

    // Adding first in $request the controller and the action
    $request->controller = $args[0];
    $request->action = $args[1];

    // Then adding other parameters
    $request->args = array_slice($args, 2);
  }

  /**
   * Connect to url.
   * @param [in] $pattern url should match.
   * @param [in, out] $url full url.
   * @param [in] $key for array Router::routes
   */
  static function connect($pattern, &$url, $key) {
    $pattern = '/'.str_replace('/', '\/', $pattern).'/';

    if (preg_match($pattern, $url, $match)) {
      self::$routes[$key] = $match[1];
      $url = trim(str_replace($match[1], '', $url), '/');
    } 
  }

  /**
   * Check if prefix in url.
   * @param [in] $pattern url should match.
   * @param [in, out] $url full url.
   */
  static function checkPrefix($pattern, &$url) {
    $pattern = '/'.str_replace('/', '\/', $pattern).'/';

    if (preg_match($pattern, $url, $match)) {
      // If prefix is in Router::$prefixes we add the prefix
      // in Router::$routes.
      if (in_array($match[1], array_keys(self::$prefixes))) {
        self::$routes['prefix'] = $match[1];
        $url = trim(str_replace($match[1], '', $url), '/');
      } 
    }
  }
} 
