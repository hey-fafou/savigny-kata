<?php

/**
 * Global class Router that won't be instanciated.
 */
class Router {
  
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
    $request->action = (!empty($args[1])) ? ($args[1]) : ('index');

    // Then adding other parameters
    $request->args = array_slice($args, 2);
  }
} 
